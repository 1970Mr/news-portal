<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Seen\App\Traits\HasSeen;

class UserMessage extends Model
{
    use HasSeen;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
