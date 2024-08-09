<?php

namespace Modules\Newsletter\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Newsletter\App\Http\Requests\Front\NewsletterRequest;
use Modules\Newsletter\App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(NewsletterRequest $request): RedirectResponse
    {
        Newsletter::create($request->validated());

        return back()->with('success', __('You have successfully subscribed to our newsletter.'));
    }
}
