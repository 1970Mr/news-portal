<?php

namespace Modules\UserActivity\App\Http\Middleware;

use Closure;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use Illuminate\Database\Eloquent\Model;
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
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        $tag = $this->getTag($request);
        $userId = $user ? $user->id : null;
        $currentIp = $request->ip();
        $userAgent = $request->userAgent();
        $referer = $request->header('referer');
        $currentUrl = $request->fullUrl();
        $deviceInfo = $this->getDeviceInfo($userAgent);

        $track = $this->getOrCreateUserTrack($userId, $currentIp, $deviceInfo);
        $this->createRequestTrack($track, $currentUrl, $referer, $tag);

        return $next($request);
    }

    /**
     * Get the tag based on the request URL.
     */
    private function getTag(Request $request): string
    {
        $panelPrefix = config('app.panel_prefix', 'panel');
        return $request->is("{$panelPrefix}*") ? $panelPrefix : 'front';
    }

    /**
     * Get the device information from the user agent.
     */
    private function getDeviceInfo(string $userAgent): array
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
        $clientHints = ClientHints::factory($_SERVER);
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();

        return [
            'browser' => $dd->getClient('name') . ' ' . $dd->getClient('version'),
            'device' => $dd->getDeviceName(),
            'os' => $dd->getOs('name') . ' ' . $dd->getOs('version') . ' - ' . $dd->getOs('platform'),
            'user_agent' => $dd->getUserAgent(),
        ];
    }

    /**
     * Get or create a user track record.
     */
    private function getOrCreateUserTrack(?int $userId, string $currentIp, array $deviceInfo): Model
    {
        return UserTrack::query()->firstOrCreate(
            ['user_id' => $userId, 'ip' => $currentIp],
            $deviceInfo
        );
    }

    /**
     * Create a new request track record.
     */
    private function createRequestTrack(Model $track, string $currentUrl, ?string $referer = null, ?string $tag = null): void
    {
        RequestTrack::create([
            'user_track_id' => $track->id,
            'url' => $currentUrl,
            'referer' => $referer,
            'tag' => $tag,
        ]);
    }
}
