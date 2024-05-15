<?php

namespace Modules\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Setting\App\Http\Requests\AboutUsRequest;
use Modules\Setting\App\Http\Requests\SocialNetworkRequest;
use Modules\Setting\App\Models\AboutUs;
use Modules\Setting\App\Services\AboutUsService;
use Modules\Setting\App\Services\SocialNetworkService;

class AboutUsController extends Controller
{
    public function __construct(private readonly AboutUsService $aboutUsService)
    {
        $this->middleware('can:' . config('permissions_list.SETTING_ABOUT_US', false));
    }

    public function edit(): View
    {
        $about = AboutUs::first();
        return view('setting::about-us', compact(['about']));
    }

    public function update(AboutUsRequest $request): RedirectResponse
    {
        $this->aboutUsService->update($request);
        return back()->with(['success' => __('entity_edited', ['entity' => __('about_us')])]);
    }
}
