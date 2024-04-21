<?php

namespace Modules\FileManager\App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileManager
{
    public static function generateFilename(UploadedFile $file): string
    {
        $filename = $file->getClientOriginalName();
        if (strlen($filename) > 170) {
            $extension = $file->getClientOriginalExtension();
            $basename = substr($filename, 0, 150);
            return $basename . '.' . $extension;
        }
        return $filename;
    }

    public static function generateFilePath($prefix = 'images'): string
    {
        return "$prefix/" . now()->format('Y/m/d') . Str::uuid();
    }
}
