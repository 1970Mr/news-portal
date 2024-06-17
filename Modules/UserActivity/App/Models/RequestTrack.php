<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestTrack extends Model
{
    protected $fillable = [
        'user_track_id',
        'url',
        'referer',
    ];

    public function userTrack(): BelongsTo
    {
        return $this->belongsTo(UserTrack::class);
    }
}
