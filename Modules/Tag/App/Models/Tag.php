<?php

namespace Modules\Tag\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Article\App\Models\Article;
use Modules\Hotness\App\Traits\HasHotness;
use Modules\Tag\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasHotness;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => Str::slug($value),
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
}
