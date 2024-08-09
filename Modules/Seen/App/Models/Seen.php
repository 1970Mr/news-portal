<?php

namespace Modules\Seen\App\Models;

use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    protected $table = 'seen';

    protected $fillable = ['seen'];

    public function seenable()
    {
        return $this->morphTo();
    }
}
