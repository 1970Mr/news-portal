<?php

namespace Modules\RedirectManager\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\RedirectManager\App\Models\Redirect;

class RedirectRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUrl = $request->fullUrl();
        $cacheMethod = config('redirect-manager.cache_method', 'full_list');

        if ($cacheMethod === 'full_list') {
            $redirect = $this->getRedirectFromFullList($currentUrl);
        } else {
            $redirect = $this->getRedirectFromIndividualCache($currentUrl);
        }

        if ($redirect) {
            return redirect($redirect->destination_url, $redirect->status_code);
        }

        return $next($request);
    }

    /**
     * Get redirect from full cached list.
     */
    protected function getRedirectFromFullList($currentUrl)
    {
        $redirects = Cache::remember('redirects_list', 60 * 60 * 24, static function () {
            return Redirect::active()->get();
        });

        return $redirects->firstWhere('source_url', $currentUrl);
    }

    /**
     * Get redirect from individual cached entry.
     */
    protected function getRedirectFromIndividualCache($currentUrl)
    {
        $cacheKey = 'redirect_'.md5($currentUrl);

        return Cache::remember($cacheKey, 60 * 60 * 24, static function () use ($currentUrl) {
            return Redirect::where('source_url', $currentUrl)->active()->first();
        });
    }
}
