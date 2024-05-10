<?php

namespace Modules\SocialNetwork\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\SocialNetwork\App\Models\SocialNetwork;

trait HasSocialNetwork
{
    public function socialNetworks(): MorphMany
    {
        return $this->morphMany(SocialNetwork::class, 'owner')->latest();
    }
}
