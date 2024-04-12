<?php

namespace Modules\FileManager\App\Traits;

use Illuminate\Http\UploadedFile;

trait FileManager
{
    public static function generateFilename(UploadedFile $file): string
    {
        $file_name = $file->getClientOriginalName();
        $hash_name = pathinfo($file->hashName(), PATHINFO_FILENAME);
        return "{$hash_name}_{$file_name}";
    }

    public static function generateFilePath($prefix = 'images'): string
    {
        return "$prefix/" . now()->format('Y/m/d');
    }
}