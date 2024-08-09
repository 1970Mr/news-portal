<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Modules\Article\App\Models\Article;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\FileManager\App\Traits\HasImage;
use Modules\SEOManager\App\Traits\SEOAble;

class Category extends Model
{
    use HasFactory;
    use HasImage;
    use Searchable;
    use SEOAble;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
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

    public function parentCategory(): ?BelongsTo
    {
        return ($this->parent_id === null)
            ? null
            : $this->category();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeParentCategories(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => Str::slug($value),
        );
    }
}
