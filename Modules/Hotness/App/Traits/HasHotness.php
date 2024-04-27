<?php

namespace Modules\Hotness\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Hotness\App\Models\Hotness;

trait HasHotness
{
    public function hotness(): MorphOne
    {
        return $this->morphOne(Hotness::class, 'hotnessable');
    }

    public function isHot(): bool
    {
        return (bool) $this->hotness()->is_hot;
    }
}
