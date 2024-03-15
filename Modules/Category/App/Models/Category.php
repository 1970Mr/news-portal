<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
//use Modules\Category\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'parent_id',
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => Str::slug($value),
        );
    }

//    protected static function newFactory(): CategoryFactory
//    {
//        return CategoryFactory::new();
//    }
}
