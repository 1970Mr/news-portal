<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
//use Modules\Category\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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

    public function parentCategory(): BelongsTo|null
    {
        return ($this->parent_id === null)
            ? null
            : $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function parentCategoryTitle(): string
    {
        return ($this->parentCategory() === null)
            ? 'ندارد'
            : $this->parentCategory()->first()->name;
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: static fn (int $value) => $value === 1 ? 'فعال' : 'غیرفعال',
            set: static fn (string $value) => (bool) $value,
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

//    protected static function newFactory(): CategoryFactory
//    {
//        return CategoryFactory::new();
//    }
}
