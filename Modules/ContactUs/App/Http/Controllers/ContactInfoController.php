<?php

namespace Modules\ContactUs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Modules\ContactUs\App\Http\Requests\ContactInfoRequest;
use Modules\ContactUs\App\Models\ContactInfo;
use Modules\ContactUs\App\Services\ContactService;

class ContactInfoController extends Controller
{
    public function __construct(private readonly ContactService $contactService)
    {
        $this->middleware('can:' . config('permissions_list.CONTACT_INFO', false));
    }

    public function edit(): View
    {
        $contact = ContactInfo::first();
        return view('setting::about-us', compact(['contact']));
    }

    public function update(ContactInfoRequest $request): RedirectResponse
    {
        $this->contactService->update($request);
        return back()->with(['success' => __('entity_edited', ['entity' => __('contact_us')])]);
    }
}
