<?php

namespace Modules\FileManager\App\Observers;

use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManager;

class ImageObserver
{
    public function deleted(Image $image): void
    {
        FileManager::delete($image->file_path);
    }
}
