<?php

namespace Modules\SEOManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\SEOManager\App\Http\Requests\SEOSettingRequest;
use Modules\SEOManager\App\SEOService;

class SEOController extends Controller
{
    public function __construct(private readonly SEOService $SEOService)
    {
        $this->middleware('can:'.config('permissions_list.SEO_MANAGEMENT', false));
    }

    public function adjustSEOSettings(SEOSettingRequest $request): RedirectResponse
    {
        $this->SEOService->updateOrCreate($request);

        return to_route($request->input('next_url'))->with('success', __('SEO settings have been registered successfully'));
    }
}
