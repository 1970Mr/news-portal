<?php

namespace Modules\UserActivity\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\UserActivity\App\Services\TrackUserRequestService;

class TrackUserRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        $trackService = new TrackUserRequestService($request, $user);
        $trackService->setUserTracking();
        $trackService->createRequestTrack($request);

        return $next($request);
    }
}
