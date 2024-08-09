<?php

namespace Modules\ContactUs\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\ContactUs\App\Http\Requests\UserMessageRequest;
use Modules\ContactUs\App\Models\ContactInfo;
use Modules\ContactUs\App\Models\UserMessage;
use Modules\SEOManager\App\Services\Front\SEOService;

class ContactUsController extends Controller
{
    public function __construct(private readonly SEOService $SEOService) {}

    public function index(): View
    {
        $this->SEOService->setContactUsPageSEO();
        $contact = ContactInfo::first();

        return view('front::contact-us.index', compact(['contact']));
    }

    public function store(UserMessageRequest $request): RedirectResponse
    {
        UserMessage::create($request->validated());

        return back()->with('success', __('Your message has been sent successfully.'));
    }
}
