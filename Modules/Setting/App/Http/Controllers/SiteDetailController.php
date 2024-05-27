<?php

namespace Modules\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Setting\App\Http\Requests\SiteDetailRequest;
use Modules\Setting\App\Models\SiteDetail;
use Modules\Setting\App\Services\SiteDetailService;

class SiteDetailController extends Controller
{
    public function __construct(private readonly SiteDetailService $detailService)
    {
        $this->middleware('can:' . config('permissions_list.SETTING_SITE_DETAILS', false));
    }

    public function edit(): View
    {
        $siteDetails = SiteDetail::with('mainLogo', 'secondLogo', 'favicon')->first();
        return view('setting::site-details', compact('siteDetails'));
    }

    public function update(SiteDetailRequest $request): RedirectResponse
    {
        $this->detailService->update($request);
        return back()->with(['success' => __('entity_edited', ['entity' => __('site_details')])]);
    }
}
