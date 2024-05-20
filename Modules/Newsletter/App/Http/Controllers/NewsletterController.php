<?php

namespace Modules\Newsletter\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Newsletter\App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.NEWSLETTER_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.NEWSLETTER_DESTROY', false))->only('destroy');
    }

    public function index(): View
    {
        $newsletters = Newsletter::query()->paginate(10);
        return view('newsletter::index', compact('newsletters'));
    }

    public function destroy(Newsletter $newsletter): View
    {
        $newsletter->delete();
        return view('newsletter::index', compact('newsletter'));
    }
}
