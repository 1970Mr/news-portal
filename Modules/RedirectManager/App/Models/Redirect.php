<?php

namespace Modules\RedirectManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'source_url',
        'destination_url',
        'status_code',
    ];
}
