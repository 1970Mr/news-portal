<?php

namespace Modules\FileManager\App\Observers;

use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManagerService;

class ImageObserver
{
    public function deleted(Image $image): void
    {
        FileManagerService::delete($image->file_path);
    }
}
