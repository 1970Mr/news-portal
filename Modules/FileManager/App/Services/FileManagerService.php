<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\FileManager\App\Traits\FileManager;

class FileManagerService
{
    use FileManager;

    public static function upload(UploadedFile $file): false|string
    {
        return Storage::disk('public')->putFileAs(
            self::generateFilePath(),
            $file,
            self::generateFilename($file)
        );
    }

    public static function delete($filePath): bool
    {
        if (Storage::disk('public')->exists($filePath))
            return Storage::disk('public')->delete($filePath);
        return false;
    }

    public static function replaceFile(UploadedFile $newFile, $filePath): false|string
    {
        $filePathWithoutName = pathinfo($filePath, PATHINFO_DIRNAME);
        $fileBaseName = pathinfo($filePath, PATHINFO_BASENAME);
        return Storage::disk('public')->putFileAs(
            $filePathWithoutName,
            $newFile,
            $fileBaseName
        );
    }
}
