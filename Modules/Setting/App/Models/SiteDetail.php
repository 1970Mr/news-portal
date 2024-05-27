<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\FileManager\App\Models\Image;

class SiteDetail extends Model
{
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'footer_text',
    ];

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

    public function getLogo($relation): string
    {
        return $relation ?
            asset('storage/' . $relation->file_path) :
            config('setting.default_logo_picture.file_link');
    }

    public function mainLogoLink(): string
    {
        return $this->getLogo($this->mainLogo);
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
