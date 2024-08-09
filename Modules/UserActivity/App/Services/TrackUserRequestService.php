<?php

namespace Modules\UserActivity\App\Services;

use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\UserActivity\App\Models\RequestTrack;
use Modules\UserActivity\App\Models\UserTrack;

class TrackUserRequestService
{
    public function __construct(
        private readonly Request $request,
        private ?Authenticatable $user = null,
        public ?Model $userTrack = null
    ) {}

    /**
     * Create a new request track record.
     */
    public function createRequestTrack(Request $request): void
    {
        RequestTrack::create([
            'user_track_id' => $this->getUserTracking()->id,
            'url' => $request->fullUrl(),
            'referer' => $request->header('referer'),
            'tag' => $this->getTag($request),
        ]);
    }

    /**
     * Get The User Track.
     */
    public function getUserTracking(): Model
    {
        if (! $this->userTrack) {
            $this->setUserTracking();
        }

        return $this->userTrack;
    }

    /**
     * Track the user.
     */
    public function setUserTracking(): void
    {
        $userId = $this->user?->id;
        $currentIp = $this->request->ip();
        $deviceInfo = $this->getDeviceInfo($this->request->userAgent());
        $deviceInfo['referer'] = $this->request->header('referer');

        $this->userTrack = $this->getOrCreateUserTrack($userId, $currentIp, $deviceInfo);
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
            'browser' => $dd->getClient('name').' '.$dd->getClient('version'),
            'device' => $dd->getDeviceName(),
            'os' => $dd->getOs('name').' '.$dd->getOs('version').' - '.$dd->getOs('platform'),
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
     * Get the tag based on the request URL.
     */
    private function getTag(Request $request): string
    {
        $panelPrefix = config('app.panel_prefix', 'panel');

        return $request->is("{$panelPrefix}*") ? $panelPrefix : 'front';
    }
}
