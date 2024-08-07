<?php

namespace Modules\MenuBuilder\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Modules\Category\App\Models\Category;
use Modules\MenuBuilder\Database\Factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;
    use Searchable;

    public const MAIN_TYPE = 'main';

    public const SUBMENU_TYPE = 'submenu';

    public const CATEGORY_TYPE = 'category';

    public const PARENT_CATEGORY_TYPE = 'parent_category';

    public const TYPES = [
        self::MAIN_TYPE,
        self::SUBMENU_TYPE,
        self::CATEGORY_TYPE,
        self::PARENT_CATEGORY_TYPE,
    ];

    protected $fillable = [
        'name',
        'url',
        'position',
        'type',
        'status',
        'parent_id',
        'category_id',
    ];

    protected static function newFactory(): MenuFactory
    {
        return MenuFactory::new();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'url' => $this->url,
        ];
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function parentMenuName(): string
    {
        return ($this->parentMenu() === null)
            ? __('have_not')
            : $this->parentMenu()->first()->getName();
    }

    public function parentMenu(): ?BelongsTo
    {
        return ($this->parent_id === null)
            ? null
            : $this->parent();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function getName(): string
    {
        return $this->name ?? $this->category->name;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function getUrl(): string
    {
        return $this->url ?? route('categories.show', $this->category->slug);
    }

    public function scopeMainMenus(Builder $query): Builder
    {
        return $query->where('type', self::MAIN_TYPE)
            ->whereNull('parent_id')
            ->whereDoesntHave('children');
    }

    public function scopeMainMenusWithChildren(Builder $query): Builder
    {
        return $query->where('type', self::MAIN_TYPE)
            ->whereNull('parent_id')
            ->whereHas('children', function (Builder $query) {
                $query->active();
            });
    }

    public function scopeCategoryMenus(Builder $query): Builder
    {
        return $query->where('type', self::CATEGORY_TYPE)
            ->whereHas('category', function (Builder $query) {
                $query->whereHas('articles', function (Builder $query) {
                    $query->active()->published();
                })->active();
            });
    }

    public function scopeParentCategoryMenus(Builder $query): Builder
    {
        return $query->where('type', self::PARENT_CATEGORY_TYPE)
            ->whereHas('category', function (Builder $query) {
                $query->whereHas('categories', function (Builder $query) {
                    $query->whereHas('articles', function (Builder $query) {
                        $query->active()->published();
                    })->active();
                })->active();
            });
    }

    public function isMainMenu(): bool
    {
        return $this->type === self::MAIN_TYPE && $this->parent_id === null && ! $this->children->isNotEmpty();
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
}
