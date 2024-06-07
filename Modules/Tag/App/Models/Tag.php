<?php

namespace Modules\Tag\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Modules\Article\App\Models\Article;
use Modules\Hotness\App\Traits\HasHotness;
use Modules\SEOManager\App\Traits\SEOAble;
use Modules\Tag\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasHotness, Searchable, SEOAble;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }

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
