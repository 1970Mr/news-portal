<?php

namespace Modules\RedirectManager\App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'source_url',
        'destination_url',
        'status_code',
    ];
}
