<?php

namespace Modules\SEOManager\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\SEOManager\App\Models\SEOSetting;

trait SEOAble
{
    public function seoSetting(): MorphOne
    {
        return $this->morphOne(SEOSetting::class, 'seoable');
    }
}
