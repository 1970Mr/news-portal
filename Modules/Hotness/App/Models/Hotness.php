<?php

namespace Modules\Hotness\App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotness extends Model
{
    protected $fillable = [
        'is_hot',
        'hotnessable_id',
        'hotnessable_type',
    ];
}
