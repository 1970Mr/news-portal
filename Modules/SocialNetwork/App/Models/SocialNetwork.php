<?php

namespace Modules\SocialNetwork\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\SocialNetwork\Database\Factories\SocialNetworkFactory;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'tag',
    ];

    protected static function newFactory(): SocialNetworkFactory
    {
        return SocialNetworkFactory::new();
    }

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }
}
