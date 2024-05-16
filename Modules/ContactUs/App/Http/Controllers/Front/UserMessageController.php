<?php

namespace Modules\ContactUs\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\ContactUs\App\Http\Requests\UserMessageRequest;
use Modules\ContactUs\App\Models\ContactInfo;
use Modules\ContactUs\App\Models\UserMessage;

class UserMessageController extends Controller
{
    public function index(): View
    {
        $contact = ContactInfo::first();
        return view('front::contact-us.index', compact(['contact']));
    }

    public function store(UserMessageRequest $request): RedirectResponse
    {
        debug('test');
        UserMessage::create($request->validated());
        return back()->with('success', __('Your message has been sent successfully.'));
    }
}
