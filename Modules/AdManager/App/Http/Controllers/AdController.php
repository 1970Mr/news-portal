<?php

namespace Modules\AdManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\AdManager\App\Models\Ad;

class AdController extends Controller
{
    public function index(): View
    {
        return view('ad-manager::index');
    }

    public function create(): View
    {
        return view('ad-manager::create');
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }

    public function edit(Ad $ad): View
    {
        return view('ad-manager::edit');
    }

    public function update(Request $request, Ad $ad): RedirectResponse
    {
        //
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        //
    }
}
