<?php

namespace Modules\PageBuilder\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Laravel\Scout\Searchable;
use Modules\FileManager\App\Traits\HasImage;
use Modules\User\App\Models\User;

class Page extends Model
{
    use HasImage, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }

    public function url(): string
    {
        return route('pages.show', ['slug' => $this->slug]);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function isActive(): bool
    {
        return $this->status === true;
    }

    public function summary(int $limit = 120): Stringable
    {
        $cleanedContent = str_replace('&nbsp;', ' ', $this->content);
        $strippedContent = strip_tags($cleanedContent);
        return str($strippedContent)->limit($limit);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function featured_image(): MorphOne
    {
        return $this->image();
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: static fn(string $value) => Str::slug($value),
        );
    }
}
