<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ContactUs\Database\factories\ContactInfoFactory;

class ContactInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): ContactInfoFactory
    {
        //return ContactInfoFactory::new();
    }
}
