<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Modules\User\App\Models\User;
use Torann\GeoIP\GeoIP;

class UserTrack extends Model
{
    use Searchable;

    protected $fillable = [
        'user_id',
        'ip',
        'device',
        'os',
        'browser',
        'user_agent',
        'referer',
    ];

    protected $appends = [
        'country',
        'city',
        'timezone',
        'last_activity',
        'pages_visit_count',
    ];

    public static function getVisitorCounts(): array
    {
        $guestVisitors = self::query()->whereNull('user_id')->distinct('ip')->count('ip');
        $memberVisitors = self::query()->whereNotNull('user_id')->distinct('user_id')->count('user_id');

        return [
            'guest' => $guestVisitors,
            'member' => $memberVisitors,
            'all' => $guestVisitors + $memberVisitors,
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'user_id' => (int) $this->user_id,
            'ip' => $this->ip,
            'device' => $this->device,
            'os' => $this->os,
            'browser' => $this->browser,
            'user_agent' => $this->user_agent,
            'referer' => $this->referer,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): Attribute
    {
        return Attribute::make(
            get: fn () => geoip($this->ip)['country'] ?? __('unknown'),
        );
    }

    public function city(): Attribute
    {
        return Attribute::make(
            get: fn () => geoip($this->ip)['city'] ?? __('unknown'),
        );
    }

    public function timezone(): Attribute
    {
        return Attribute::make(
            get: fn () => geoip($this->ip)['timezone'] ?? __('unknown'),
        );
    }

    public function getGeoIp(): GeoIP
    {
        return geoip($this->ip);
    }

    public function lastActivity(): Attribute
    {
        $lastActivity = $this->requestTracks()->latest()->first()?->created_at;

        return Attribute::make(
            get: fn () => $lastActivity ?
                date('Y-m-d H:i:s', $lastActivity->getTimestamp()) :
                null
        );
    }

    public function requestTracks(): HasMany
    {
        return $this->hasMany(RequestTrack::class);
    }

    public function getLastActivity(): string
    {
        return $this->last_activity ?
            jalalian()->forge($this->last_activity)->ago() :
            __('unknown');
    }

    public function pagesVisitCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->requestTracks()->count(),
        );
    }

    public function isOnline(): bool
    {
        $lastActivityThreshold = now()->subMinutes(5);

        return $this->last_activity && $this->last_activity >= $lastActivityThreshold;
    }
}
