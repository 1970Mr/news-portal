<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\FileManager\App\Models\Image;
use Modules\Setting\Database\Factories\SiteDetailFactory;

class SiteDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'footer_text',
    ];

    protected static function newFactory(): SiteDetailFactory
    {
        return SiteDetailFactory::new();
    }

    public function mainLogo(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'main_logo_id');
    }

    public function secondLogo(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'second_logo_id');
    }

    public function favicon(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'favicon_id');
    }

    public function mainLogoLink(): string
    {
        return $this->getLogo($this->mainLogo);
    }

    public function getLogo($relation): string
    {
        return $relation ?
            asset('storage/'.$relation->file_path) :
            config('common.default_logo.file_link');
    }

    public function secondLogoLink(): string
    {
        return $this->getLogo($this->secondLogo);
    }

    public function faviconLink(): string
    {
        return $this->getLogo($this->favicon);
    }
}
