<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Database\Factories\AboutUsFactory;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    protected static function newFactory(): AboutUsFactory
    {
        return AboutUsFactory::new();
    }
}
