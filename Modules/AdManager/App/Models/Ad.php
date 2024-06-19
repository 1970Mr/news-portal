<?php

namespace Modules\AdManager\App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Modules\FileManager\App\Traits\HasImage;

class Ad extends Model
{
    use HasImage, Searchable;

    public const HEADER = "header";
    public const FIRST_SIDEBAR = "first_sidebar";
    public const SECOND_SIDEBAR = "second_sidebar";
    public const FIRST_SECTION = "first_section";
    public const SECOND_SECTION = "second_section";
    public const THIRD_SECTION = "third_section";
    public const FOURTH_SECTION = "fourth_section";
    public const SECTIONS = [
        self::HEADER,
        self::FIRST_SIDEBAR,
        self::SECOND_SIDEBAR,
        self::FIRST_SECTION,
        self::SECOND_SECTION,
        self::THIRD_SECTION,
        self::FOURTH_SECTION,
    ];
    protected $fillable = [
        'title',
        'link',
        'section',
        'published_at',
        'expired_at',
        'status',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'link' => $this->link,
        ];
    }

    public function getSection(): ?string
    {
        return self::SECTIONS[$this->section] ?? null;
    }

    public function scopeBySection(Builder $query, int|string $section): Builder
    {
        if (is_string($section)) {
            $section = $this->getNumberSection($section);
        }
        return $query->where('section', $section);
    }

    public function getNumberSection(string $section): int
    {
        return array_search($section, self::SECTIONS, true);
    }

    public function scopeActive(Builder $query): Builder
    {
        $now = Carbon::now();
        return $query->where('status', true)
            ->where('published_at', '<=', $now)
            ->where(function (Builder $query) use ($now) {
                $query->whereNull('expired_at')
                    ->orWhere('expired_at', '>=', $now);
            });
    }
}
