<?php

namespace Modules\FileManager\App\Helpers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManager;

class ImageHelper
{
    public static function createDefaultImage(int $userId = null, string $altText = 'Default Image', string $configPath = 'common.default_image.file_path'): Model
    {
        $defaultImagePath = config($configPath);

        if (!file_exists($defaultImagePath)) {
            throw new Exception("Default image file not found: {$defaultImagePath}");
        }
        $uploadedFile = new UploadedFile($defaultImagePath, basename($defaultImagePath));
        $uploadedFilePath = FileManager::uploadFromFile($uploadedFile);
        if (!$uploadedFilePath) {
            throw new Exception("Failed to upload default image.");
        }

        return Image::query()->create([
            'file_path' => $uploadedFilePath,
            'alt_text' => $altText,
            'user_id' => $userId,
        ]);
    }
}
