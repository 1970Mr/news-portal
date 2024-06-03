<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Database\Factories\ContactInfoFactory;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_info';

    protected $fillable = [
        'title',
        'content',
        'address',
        'email',
        'phone',
    ];

    protected static function newFactory()
    {
        return ContactInfoFactory::new();
    }
}
