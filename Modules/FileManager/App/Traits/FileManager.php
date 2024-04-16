<?php

namespace Modules\FileManager\App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileManager
{
    public static function generateFilename(UploadedFile $file): string
    {
        return $file->getClientOriginalName();
    }

    public static function generateFilePath($prefix = 'images'): string
    {
        return "$prefix/" . now()->format('Y/m/d') . Str::uuid();
    }
}
