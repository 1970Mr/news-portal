<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestTrack extends Model
{
    protected $fillable = [
        'user_track_id',
        'url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserTrack::class);
    }
}
