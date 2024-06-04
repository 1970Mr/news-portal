<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Modules\Article\App\Models\Article;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\FileManager\App\Traits\HasImage;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasImage, Searchable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'parent_id',
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
            set: static fn(string $value) => Str::slug($value),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function parentCategory(): BelongsTo|null
    {
        return ($this->parent_id === null)
            ? null
            : $this->category();
    }

    public function categories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function parentCategoryTitle(): string
    {
        return ($this->parentCategory() === null)
            ? __('have_not')
            : $this->parentCategory()->first()->name;
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function update(array $attributes = [], array $options = []): bool
    {
        $this->touch();
        return parent::update($attributes, $options);
    }

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
