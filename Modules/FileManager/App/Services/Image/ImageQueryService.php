<?php

namespace Modules\FileManager\App\Services\Image;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\FileManager\App\Models\Image;

class ImageQueryService
{
    public function __construct(private readonly ImagePermissionService $imagePermissionService) {}

    public function getAllImages(Request $request): Builder
    {
        Gate::authorize('index', Image::class);
        $query = Image::query()->latest();
        $query = $this->imagePermissionService->setPermissionsFilter($query);
        $searchText = $request->get('query');
        if ($searchText) {
            $imagesIds = $this->search($searchText)->pluck('id');
            $query->whereIn('id', $imagesIds);
        }

        return $this->setShowItemsFilter($request, $query);
    }

    private function search(mixed $searchText): Collection
    {
        return Image::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in users
            $query->orWhereHas('user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->get();
    }

    private function setShowItemsFilter(Request $request, Builder $query): Builder
    {
        if ($request->has('filter') && $this->imagePermissionService->canAccessAllImages()) {
            $filter = $request->filter;
            if ($filter === Image::MY_IMAGES) {
                $query->where('user_id', auth()->id());
            } elseif ($filter === Image::OTHER_USERS_IMAGES) {
                $query->where('user_id', '!=', auth()->id());
            }
        }

        return $query;
    }
}
