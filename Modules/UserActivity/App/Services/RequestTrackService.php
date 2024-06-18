<?php

namespace Modules\UserActivity\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\UserActivity\App\Models\RequestTrack;

class RequestTrackService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $requestsTrack = $this->search($searchText);
        } else {
            $requestsTrack = RequestTrack::with('userTrack.user')->latest()->paginate(10);
        }
        return $requestsTrack;
    }

    private function search(mixed $searchText): Paginator
    {
        return RequestTrack::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in users
            $query->orWhereHas('userTrack.user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }
}
