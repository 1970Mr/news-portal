<?php

namespace Modules\AdManager\App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Modules\FileManager\App\Traits\HasImage;

class Ad extends Model
{
    use HasImage;

    protected $fillable = [
        'title',
        'link',
        'section',
        'published_at',
        'expired_at',
        'status',
    ];

    public const HEADER = "header";
    public const FIRST_SIDEBAR = "first_sidebar";
    public const SECOND_SIDEBAR = "second_sidebar";
    public const THIRD_SIDEBAR = "third_sidebar";
    public const FIRST_CONTENT = "first_content";
    public const SECOND_CONTENT = "second_content";
    public const THIRD_CONTENT = "third_content";
    public const FOURTH_CONTENT = "fourth_content";

    public const SECTIONS = [
        self::HEADER,
        self::FIRST_SIDEBAR,
        self::SECOND_SIDEBAR,
        self::THIRD_SIDEBAR,
        self::FIRST_CONTENT,
        self::SECOND_CONTENT,
        self::THIRD_CONTENT,
        self::FOURTH_CONTENT,
    ];

    public function getSection(): ?string
    {
        return self::SECTIONS[$this->section] ?? null;
    }

    public function scopeBySection(Builder $query, int $section): Builder
    {
        return $query->where('section', $section);
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
