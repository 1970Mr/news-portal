<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\FileManager\App\Services\FileManagerService;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'alt_text',
        'title',
        'description',
    ];

    public function delete(): bool|null
    {
        // TODO: Added a check that the file is not used anywhere by checking that there is no data in the relations
        FileManagerService::delete($this->file_path);
        return parent::delete();
    }
}
