<?php

namespace Modules\FileManager\App\Services\Image;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Modules\FileManager\App\Exceptions\ImageDeleteException;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManager;

class ImageService
{
    public function __construct(
        private readonly ImageQueryService $imageQueryService,
    )
    {
    }

    public function index(Request $request): Paginator
    {
        return $this->imageQueryService->getAllImages($request)->paginate(10)->appends('query', $request->get('query'));
    }

    public function update(ImageRequest $request, image $image): bool
    {
        Gate::authorize('update', $image);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['file_path'] = FileManager::replaceFile($file, $image->file_path);
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

    public function imageSelectorData(Request $request): Collection
    {
        return $this->imageQueryService->getAllImages($request)->get();
    }

    public function uploadImageDuringUpdate(Request $request, Model $model, $altText = 'Default Alt Text'): void
    {
        if ($request->hasFile('image')) {
            $this->destroyWithoutKeyConstraints($model->image);
            $image = $this->store($request, altText: $altText);
            $model->image()->save($image);
        }
    }

    public function destroyWithoutKeyConstraints(?Image $image): bool|null
    {
        if (!$image) {
            return null;
        }
        Schema::disableForeignKeyConstraints();
        $result = $image->delete();
        Schema::enableForeignKeyConstraints();
        return $result;
    }

    public function store(Request $request, $fileName = 'image', $altText = 'Default Alt Text'): Model
    {
//        Gate::authorize('store', Image::class);
        $data['file_path'] = FileManager::upload($request->file($fileName));
        $data['alt_text'] = $request->get('alt_text', $altText);
        $data['user_id'] = auth()->id();
        return Image::query()->create($data);
    }
}
