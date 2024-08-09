<?php

namespace Modules\Newsletter\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Newsletter\App\Models\Newsletter;
use Modules\Newsletter\App\Services\NewsletterService;

class NewsletterController extends Controller
{
    public function __construct(private readonly NewsletterService $newsletterService)
    {
        $this->middleware('can:'.config('permissions_list.NEWSLETTER_INDEX', false))->only('index');
        $this->middleware('can:'.config('permissions_list.NEWSLETTER_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $newsletters = $this->newsletterService->index($request);

        return view('newsletter::index', compact('newsletters'));
    }

    public function destroy(Newsletter $newsletter): RedirectResponse
    {
        $newsletter->delete();

        return back()->with('success', __('entity_deleted', ['entity' => __('newsletter')]));
    }
}
