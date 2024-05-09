<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Modules\FileManager\App\Exceptions\ImageDeleteException;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageService
{
    public function index(Request $request): Paginator
    {
        return $this->getAllImages($request)->paginate(10);
    }

    public function imageSelectorData(Request $request): Collection
    {
        return $this->getAllImages($request)->get();
    }

    public function store(Request $request, $fileName = 'image', $altText = 'Default alt text'): Model
    {
//        Gate::authorize('store', Image::class);
        $data['file_path'] = FileManagerService::upload( $request->file($fileName) );
        $data['alt_text'] = $request->get('alt_text', $altText);
        $data['user_id'] = auth()->id();
        return Image::query()->create($data);
    }

    public function update(ImageRequest $request, image $image): bool
    {
        Gate::authorize('update', $image);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
//            FileManagerService::delete($image->file_path);
            $data['file_path'] = FileManagerService::replaceFile($file, $image->file_path);
        }
        $data['alt_text'] = $request->alt_text;
        return $image->update($data);
    }

    /**
     * @throws ImageDeleteException
     */
    public function destroy(Image $image): bool|null
    {
        Gate::authorize('destroy', $image);
        if ($image->imageable) {
            throw new ImageDeleteException(__('This image cannot be deleted! Because it has been used elsewhere.'));
        }
        return $image->delete();
    }

    public function destroyWithoutKeyConstraints(Image $image): bool|null
    {
        Schema::disableForeignKeyConstraints();
        $result = $image->delete();
        Schema::enableForeignKeyConstraints();
        return $result;
    }

    private function setFilters(Request $request, Builder $query): Builder
    {
        if ($request->has('filter') && $this->canAccessAllImages()) {
            $filter = $request->filter;
            if ($filter === Image::MY_IMAGE) {
                $query->where('user_id', auth()->id());
            } elseif ($filter === Image::OTHER_USERS_IMAGE) {
                $query->where('user_id', '!=', auth()->id());
            }
        }
        return $query;
    }

    private function setPermissionsFilter(Builder $query): Builder
    {
        if ( !$this->canAccessAllImages() ) {
            $query->where('user_id', auth()->id());
        }
        return $query;
    }

    public function canAccessAllImages(): bool
    {
        return auth()->user()?->can(config('permissions_list.IMAGE_INDEX_ALL', false));
    }

    private function getAllImages(Request $request): Builder
    {
        Gate::authorize('index', Image::class);
        $query = Image::query()->latest();
        $query = $this->setPermissionsFilter($query);
        return $this->setFilters($request, $query);
    }

    public function uploadImageDuringUpdate(Request $request, Model $model, $altText = 'Default alt text'): void
    {
        if ($request->hasFile('image')) {
            $this->destroyWithoutKeyConstraints($model->image);
            $image = $this->store($request, altText: $altText);
            $model->image()->save($image);
        }
    }
}
