<?php

namespace Modules\UserActivity\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackUserRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
