<?php

namespace Modules\Menu\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
//use Modules\Menu\Database\Factories\MenuFactory;
use Modules\Category\App\Models\Category;

class Menu extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'name',
        'url',
        'position',
        'type',
        'status',
        'parent_id',
        'category_id',
    ];

    public const MAIN_TYPE = 'main';
    public const CATEGORY_TYPE = 'category';
    public const PARENT_CATEGORY_TYPE = 'parent_category';

    public const TYPES = [
        self::MAIN_TYPE,
        self::CATEGORY_TYPE,
        self::PARENT_CATEGORY_TYPE,
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'url' => $this->url,
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function parentMenu(): BelongsTo|null
    {
        return ($this->parent_id === null)
            ? null
            : $this->parent();
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function parentMenuTitle(): string
    {
        return ($this->parentMenu() === null)
            ? __('have_not')
            : $this->parentMenu()->first()->name;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function getName(): string
    {
        return $this->name ?? $this->category->name;
    }

    public function getUrl(): string
    {
        return $this->url ?? route('categories.show', $this->category->slug);
    }

    public function scopeMainMenus(Builder $query): Builder
    {
        return $query->where('type', self::MAIN_TYPE)
            ->whereNull('parent_id')
            ->whereDoesntHave('children')
            ->orderBy('position');
    }

    public function scopeMainMenusWithChildren(Builder $query): Builder
    {
        return $query->where('type', self::MAIN_TYPE)
            ->whereNull('parent_id')
            ->whereHas('children')
            ->orderBy('position');
    }

    public function scopeCategoryMenus(Builder $query): Builder
    {
        return $query->where('type', self::CATEGORY_TYPE)
            ->orderBy('position');
    }

    public function scopeParentCategoryMenus(Builder $query): Builder
    {
        return $query->where('type', self::PARENT_CATEGORY_TYPE)
            ->orderBy('position');
    }

    public function isMainMenu(): bool
    {
        return $this->type === self::MAIN_TYPE && $this->parent_id === null && !$this->children->isNotEmpty();
    }

    public function isMainMenuWithChildren(): bool
    {
        return $this->type === self::MAIN_TYPE && $this->parent_id === null && $this->children->isNotEmpty();
    }

    public function isCategoryMenu(): bool
    {
        return $this->type === self::CATEGORY_TYPE;
    }

    public function isParentCategoryMenu(): bool
    {
        return $this->type === self::PARENT_CATEGORY_TYPE;
    }


//    protected static function newFactory(): MenuFactory
//    {
//        return MenuFactory::new();
//    }
}
