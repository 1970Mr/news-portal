<?php

namespace Modules\SocialNetwork\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SocialNetwork extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'url',
        'icon',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }
}
