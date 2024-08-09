<?php

namespace Modules\Setting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Setting\App\Services\CacheService;

class CacheController extends Controller
{
    public function __construct(private readonly CacheService $cacheClearService)
    {
        //        $this->middleware('can:' . config('permissions_list.CACHE_INDEX', false))->only('index');
        //        $this->middleware('can:' . config('permissions_list.CACHE_CLEAR_ALL', false))->only('clearAllCache');
        //        $this->middleware('can:' . config('permissions_list.CACHE_CLEAR_APPLICATION', false))->only('clearApplicationCache');
        //        $this->middleware('can:' . config('permissions_list.CACHE_CLEAR_VIEW', false))->only('clearViewCache');
        //        $this->middleware('can:' . config('permissions_list.CACHE_CLEAR_CONFIG', false))->only('clearConfigCache');
        //        $this->middleware('can:' . config('permissions_list.CACHE_CLEAR_ROUTE', false))->only('clearRouteCache');
    }

    public function index(): View
    {
        return view('setting::cache-management');
    }

    public function clearAllCache(): RedirectResponse
    {
        $this->cacheClearService->clearAllCache();

        return redirect()->back()->with('success', __('setting::cache.all_cleared'));
    }

    public function clearApplicationCache(): RedirectResponse
    {
        $this->cacheClearService->clearApplicationCache();

        return redirect()->back()->with('success', __('setting::cache.application_cleared'));
    }

    public function clearViewCache(): RedirectResponse
    {
        $this->cacheClearService->clearViewCache();

        return redirect()->back()->with('success', __('setting::cache.view_cleared'));
    }

    public function clearConfigCache(): RedirectResponse
    {
        $this->cacheClearService->clearConfigCache();

        return redirect()->back()->with('success', __('setting::cache.config_cleared'));
    }

    public function clearRouteCache(): RedirectResponse
    {
        $this->cacheClearService->clearRouteCache();

        return redirect()->back()->with('success', __('setting::cache.route_cleared'));
    }
}
