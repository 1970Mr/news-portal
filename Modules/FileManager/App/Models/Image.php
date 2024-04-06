<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'alt_text',
        'title',
        'description',
    ];
}
