<?php

namespace Modules\UserActivity\App\Http\Middleware;

use Closure;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\UserActivity\App\Models\RequestTrack;
use Modules\UserActivity\App\Models\UserTrack;

class TrackUserRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $currentIp = $request->ip();
        $userAgent = $request->userAgent();
        $referer = $request->header('referer');
        $currentUrl = $request->fullUrl();

        // Initialize DeviceDetector
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
        $clientHints = ClientHints::factory($_SERVER);
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();

        $browser = $dd->getClient('name') . ' ' . $dd->getClient('version');
        $device = $dd->getDeviceName();
        $os = $dd->getOs('name') . ' ' . $dd->getOs('version') . ' - ' . $dd->getOs('platform');

        // Fetch or create track record
        $track = UserTrack::query()->firstOrCreate(
            ['user_id' => $userId, 'ip' => $currentIp],
            [
                'device' => $device,
                'os' => $os,
                'browser' => $browser,
                'user_agent' => $userAgent,
                'referer' => $referer,
            ]
        );

        // Create a new RequestTrack record
        RequestTrack::create([
            'user_track_id' => $track->id,
            'url' => $currentUrl,
            'referer' => $referer,
        ]);

        return $next($request);
    }
}
