<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class RequestTrack extends Model
{
    use Searchable;

    protected $fillable = [
        'user_track_id',
        'url',
        'referer',
        'tag',
    ];

    public static function getVisitCounts(): array
    {
        $now = Carbon::now();

        $hourCount = self::where('created_at', '>=', $now->subHour())->count();
        $tenHoursCount = self::where('created_at', '>=', $now->subHours(10))->count();
        $dayCount = self::where('created_at', '>=', $now->subDay())->count();

        $weekCount = self::where('created_at', '>=', $now->subWeek())->count();
        $monthCount = self::where('created_at', '>=', $now->subMonth())->count();
        $yearCount = self::where('created_at', '>=', $now->subYear())->count();

        $allCount = self::count();

        return [
            'hourly' => $hourCount,
            'ten_hours' => $tenHoursCount,
            'daily' => $dayCount,
            'weekly' => $weekCount,
            'monthly' => $monthCount,
            'yearly' => $yearCount,
            'all' => $allCount,
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'user_track_id' => (int)$this->user_track_id,
            'url' => $this->url,
            'referer' => $this->referer,
            'tag' => $this->tag,
        ];
    }

    public function userTrack(): BelongsTo
    {
        return $this->belongsTo(UserTrack::class);
    }
}
