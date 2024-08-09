<?php

namespace Modules\RedirectManager\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Redirect extends Model
{
    use Searchable;

    protected $fillable = [
        'source_url',
        'destination_url',
        'status_code',
        'status',
    ];

    protected static function booted(): void
    {
        $cacheMethod = config('redirect-manager.cache_method', 'full_list');
        static::saved(static function ($redirect) use ($cacheMethod) {
            if ($cacheMethod === 'full_list') {
                Cache::forget('redirects_list');
            } else {
                Cache::forget("redirect_{$redirect->source_url}");
            }
        });

        static::deleted(static function ($redirect) use ($cacheMethod) {
            if ($cacheMethod === 'full_list') {
                Cache::forget('redirects_list');
            } else {
                Cache::forget("redirect_{$redirect->source_url}");
            }
        });

        parent::booted();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'source_url' => $this->source_url,
            'destination_url' => $this->destination_url,
            'status_code' => $this->status_code,
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    protected function source_url(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => trim($value, '/'),
        );
    }

    protected function destination_url(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => trim($value, '/'),
        );
    }
}
