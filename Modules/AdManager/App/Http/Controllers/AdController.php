<?php

namespace Modules\AdManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\AdManager\App\Http\Requests\AdRequest;
use Modules\AdManager\App\Models\Ad;

class AdController extends Controller
{
    public function index(): View
    {
        $ads = Ad::query()->latest()->get();
        return view('ad-manager::index', compact('ads'));
    }

    public function create(): View
    {
        return view('ad-manager::create');
    }

    public function store(AdRequest $request): RedirectResponse
    {
        Ad::create($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.ads.index')->
            with('success', __('entity_created', ['entity' => __('ad')]));
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
