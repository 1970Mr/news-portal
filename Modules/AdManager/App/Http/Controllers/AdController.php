<?php

namespace Modules\AdManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\AdManager\App\Http\Requests\AdRequest;
use Modules\AdManager\App\Models\Ad;
use Modules\AdManager\App\Services\AdService;

class AdController extends Controller
{
    public function __construct(private readonly AdService $adService,)
    {
//        $this->middleware('can:' . config('permissions_list.AD_INDEX', false))->only('index');
//        $this->middleware('can:' . config('permissions_list.AD_STORE', false))->only('store');
//        $this->middleware('can:' . config('permissions_list.AD_UPDATE', false))->only('update');
//        $this->middleware('can:' . config('permissions_list.AD_DESTROY', false))->only('destroy');
    }

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
        $this->adService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.ads.index')->
            with('success', __('entity_created', ['entity' => __('ad')]));
    }

    public function edit(Ad $ad): View
    {
        return view('ad-manager::edit', compact('ad'));
    }

    public function update(AdRequest $request, Ad $ad): RedirectResponse
    {
        $this->adService->update($request, $ad);
        return to_route(config('app.panel_prefix', 'panel') . '.ads.index')->
            with('success', __('entity_edited', ['entity' => __('ad')]));
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        $this->adService->destroy($ad);
        return back()->with('success', __('deleted_edited', ['entity' => __('ad')]));
    }
}
