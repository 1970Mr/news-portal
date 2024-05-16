<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Seen\App\Traits\HasSeen;

class UserMessage extends Model
{
    use HasSeen;

    public const SEEN = 'seen';
    public const UNSEEN = 'unseen';
    public const USER_MESSAGE_STATUS = [
        self::SEEN,
        self::UNSEEN,
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
