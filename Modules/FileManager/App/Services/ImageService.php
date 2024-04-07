<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageService
{
    public function index(Request $request): Paginator
    {
        if (!$this->canAccessAnyImage()) {
            abort(403);
        }
        $query = Image::query()->latest();
        $query = $this->setPermissionsFilter($query);
        $query = $this->setFilters($request, $query);
        return $query->paginate(10);
    }

    public function store(ImageRequest $request): Model
    {
        $data = $request->validated();
        $data['file_path'] = FileManagerService::upload( $request->file('image') );
        $data['user_id'] = auth()->id();
        return Image::query()->create($data);
    }

    public function update(ImageRequest $request, image $image): bool
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['file_path'] = FileManagerService::upload($file);
            FileManagerService::delete($image->file_path);
        }
        return $image->update($data);
    }

    public function destroy(Image $image): bool|null
    {
        return $image->delete();
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
        return auth()->user()?->can(config('permissions_list.IMAGE_INDEX_ALL'));
    }

    public function canAccessAnyImage(): mixed
    {
        return auth()->user()?->canAny([
            config('permissions_list.IMAGE_INDEX_ALL'),
            config('permissions_list.IMAGE_INDEX_OWN')
        ]);
    }
}
