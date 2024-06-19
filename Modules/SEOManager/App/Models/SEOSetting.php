<?php

namespace Modules\SEOManager\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SEOSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'canonical_url',
        'robots',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function robots(): Attribute
    {
        return Attribute::make(
            set: static fn(?string $value) => $value ?? 'index, follow',
        );
    }
}
