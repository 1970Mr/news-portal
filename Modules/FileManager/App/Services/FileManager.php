<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManager
{
    public static function upload(UploadedFile $file, string $disk = 'public'): false|string
    {
        return Storage::disk($disk)->putFileAs(
            self::generateFilePath(),
            $file,
            self::generateFilename($file)
        );
    }

    public static function generateFilePath($prefix = 'images'): string
    {
        return "$prefix/".now()->format('Y/m/d').Str::uuid();
    }

    public static function generateFilename(UploadedFile $file): string
    {
        $filename = $file->getClientOriginalName();
        if (strlen($filename) > 170) {
            $extension = $file->getClientOriginalExtension();
            $basename = substr($filename, 0, 150);

            return $basename.'.'.$extension;
        }

        return $filename;
    }

    public static function uploadFromFile(string $filePath): false|string
    {
        if (! file_exists($filePath)) {
            return false;
        }
        $filename = pathinfo($filePath, PATHINFO_BASENAME);
        $destinationPath = self::generateFilePath();

        return Storage::disk('public')->putFileAs(
            $destinationPath,
            $filePath,
            $filename
        );
    }

    public static function delete(string $filePath): bool
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }

        return false;
    }

    public static function replaceFile(UploadedFile $newFile, string $filePath): false|string
    {
        $filePathWithoutName = pathinfo($filePath, PATHINFO_DIRNAME);
        $fileBaseName = pathinfo($filePath, PATHINFO_BASENAME);

        return Storage::disk('public')->putFileAs(
            $filePathWithoutName,
            $newFile,
            $fileBaseName
        );
    }

    public static function getReadableSize(?int $size): string
    {
        if (is_null($size)) {
            return __('unknown');
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $base = 1024;
        $i = floor(log($size, $base));
        $readableSize = round($size / ($base ** $i), 2);

        return $readableSize.' '.$units[$i];
    }
}
