<?php

namespace Modules\ContactUs\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\ContactUs\App\Models\ContactInfo;

class UserMessageController extends Controller
{
    public function index(): View
    {
        $contact = ContactInfo::first();
        return view('front::contact-us.index', compact(['contact']));
    }
}
