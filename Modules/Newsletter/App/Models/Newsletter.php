<?php

namespace Modules\Newsletter\App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'email',
        'subscribed_at'
    ];
}
