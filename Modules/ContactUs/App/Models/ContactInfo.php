<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_info';

    protected $fillable = [
        'title',
        'content',
        'address',
        'email',
        'phone',
    ];
}
