<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'address',
        'email',
        'phone',
    ];
}
