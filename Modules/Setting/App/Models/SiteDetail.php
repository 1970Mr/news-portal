<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\FileManager\App\Models\Image;

class SiteDetail extends Model
{
    protected $fillable = [
        'footer_description'
    ];

    public function headerLogo(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'header_logo_id');
    }

    public function footerLogo(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'footer_logo_id');
    }

    public function getLogo($relation): string
    {
        return $relation ?
            config('setting.default_logo_picture.file_link') :
            asset('storage/' . $relation->file_path);
    }

    public function headerLogoLink(): string
    {
        return $this->getLogo($this->headerLogo);
    }

    public function footerLogoLink(): string
    {
        return $this->getLogo($this->footerLogo);
    }
}
