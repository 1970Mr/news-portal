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

    public function footerLogo(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'footer_logo_id');
    }
}
