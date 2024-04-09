<?php

namespace Modules\FileManager\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\FileManager\App\Models\Image;
use Modules\User\App\Models\User;

class ImagePolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->canAny([
            config('permissions_list.IMAGE_INDEX_ALL'),
            config('permissions_list.IMAGE_INDEX_OWN')
        ]);
    }

    public function store(User $user): bool
    {
        return $user->can(config('permissions_list.IMAGE_STORE'));
    }
}
