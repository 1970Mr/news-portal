<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Traits\FileManager;

class ImageService
{
    use FileManager;

    public function store(ImageRequest $request): Model
    {
        $data = $request->validated();
        $file = $request->file('image');
        $data['file_path'] = Storage::disk('public')->putFileAs(
            $this->generateFilePath(),
            $file,
            $this->generateFilename($file)
        );
        return Image::query()->create($data);
    }
}
