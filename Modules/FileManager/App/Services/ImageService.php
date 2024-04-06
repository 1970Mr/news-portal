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
}
