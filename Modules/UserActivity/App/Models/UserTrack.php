<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\App\Models\User;

class UserTrack extends Model
{
    protected $fillable = [
        'user_id',
        'ip',
        'device',
        'browser',
        'referrer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
