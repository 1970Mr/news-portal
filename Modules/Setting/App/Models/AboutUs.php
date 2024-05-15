<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];
}
