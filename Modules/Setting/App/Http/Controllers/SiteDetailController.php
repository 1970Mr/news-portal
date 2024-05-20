<?php

namespace Modules\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Setting\App\Models\SiteDetail;

class SiteDetailController extends Controller
{
    public function edit(): View
    {
        $siteDetail = SiteDetail::with('footerLogo', 'headerLogo')->first();
        return view('setting::header', compact('siteDetail'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }
}
