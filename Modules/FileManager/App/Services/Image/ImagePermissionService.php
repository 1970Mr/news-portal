<?php

namespace Modules\FileManager\App\Services\Image;

use Illuminate\Database\Eloquent\Builder;

class ImagePermissionService
{
    public function setPermissionsFilter(Builder $query): Builder
    {
        if (! $this->canAccessAllImages()) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public function canAccessAllImages(): bool
    {
        return auth()->user()?->can(config('permissions_list.IMAGE_INDEX_ALL', false));
    }
}
