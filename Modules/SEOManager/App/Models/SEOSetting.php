<?php

namespace Modules\SEOManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\SEOManager\Database\factories\SeoSettingFactory;

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
}
