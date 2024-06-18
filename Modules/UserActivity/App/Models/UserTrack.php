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

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id,
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

    public function requestTracks(): HasMany
    {
        return $this->hasMany(RequestTrack::class);
    }

    public function country(): Attribute
    {
        return Attribute::make(
            get: fn() => geoip($this->ip)['country'] ?? __('unknown'),
        );
    }

    public function city(): Attribute
    {
        return Attribute::make(
            get: fn() => geoip($this->ip)['city'] ?? __('unknown'),
        );
    }

    public function timezone(): Attribute
    {
        return Attribute::make(
            get: fn() => geoip($this->ip)['timezone'] ?? __('unknown'),
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
            get: fn() => $lastActivity ?
                jalalian()->forge($lastActivity)->ago() :
                __('unknown'),
        );
    }

    public function pagesVisitCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->requestTracks()->count(),
        );
    }

    public static function getVisitorCounts(): array
    {
        $guestVisitors = self::query()->groupBy('ip')->whereNull('user_id')->count();
        $memberVisitors = self::query()->groupBy('user_id')->whereNotNull('user_id')->count();
        return [
            'guest' => $guestVisitors,
            'member' => $memberVisitors,
            'all' => $guestVisitors + $memberVisitors
        ];
    }
}
