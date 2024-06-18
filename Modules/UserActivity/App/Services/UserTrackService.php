<?php

namespace Modules\UserActivity\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\UserActivity\App\Models\UserTrack;

class UserTrackService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $usersTrack = $this->search($searchText);
        } else {
            $usersTrack = UserTrack::with('user')->latest()->paginate(10);
        }
        return $usersTrack;
    }

    private function search(mixed $searchText): Paginator
    {
        return UserTrack::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in users
            $query->orWhereHas('user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }
}
