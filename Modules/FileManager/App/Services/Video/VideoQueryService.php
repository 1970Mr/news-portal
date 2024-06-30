<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\FileManager\App\Models\Video;

class VideoQueryService
{
    public function index(Request $request): Paginator
    {
        Gate::authorize('index', Video::class);
        $query = Video::query()->latest();
        $this->setSearchFilter($request, $query);
        $this->setPermissionsFilter($query);
        $this->setShowItemsFilter($request, $query);
        return $query->latest()->paginate(10);
    }

    public function setPermissionsFilter(Builder $query): Builder
    {
        if (Gate::denies('all', Video::class)) {
            $query->where('user_id', auth()->id());
        }
        return $query;
    }

    private function setShowItemsFilter(Request $request, Builder $query): Builder
    {
        if (Gate::allows('all', Video::class) && $request->has('filter')) {
            $filter = $request->filter;
            if ($filter === Video::MY_VIDEOS) {
                $query->where('user_id', auth()->id());
            } elseif ($filter === Video::OTHER_USERS_VIDEOS) {
                $query->where('user_id', '!=', auth()->id());
            }
        }
        return $query;
    }

    public function setSearchFilter(Request $request, Builder $query): Builder
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $videosIds = $this->search($searchText)->pluck('id');
            $query->whereIn('id', $videosIds);
        }
        return $query;
    }

    private function search(mixed $searchText): Collection
    {
        return Video::query()->where(static function (Builder $query) use ($searchText) {
            $query->with('media');
            // Search in media
            $query->whereHas('media', function (Builder $q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%")
                    ->orWhere('mime_type', 'like', "%{$searchText}%");
            });

            // Search in users
            $query->orWhereHas('user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->get();
    }
}
