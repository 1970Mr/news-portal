<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageService
{
    public function store(ImageRequest $request): Model
    {
        $data = $request->validated();
        $file = $request->file('image');
        $data['file_path'] = FileManagerService::upload($file);
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
}
