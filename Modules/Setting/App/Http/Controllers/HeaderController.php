<?php

namespace Modules\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeaderController extends Controller
{
    public function edit(): View
    {
        return view('setting::header');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }
}
