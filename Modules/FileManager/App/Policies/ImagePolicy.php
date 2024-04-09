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

    public function show(User $user, Image $image): bool
    {
        $canShowAll = $user->can(config('permissions_list.IMAGE_INDEX_ALL'));
        $canShowOwn = $user->can(config('permissions_list.IMAGE_INDEX_OWN'));

        // If the user can't see any image but can see own image and the image being showed is not their own, return false
        if ((!$canShowAll && $canShowOwn) && $image->user_id !== $user->id) {
            return false;
        }

        return $canShowOwn || $canShowAll;
    }

    public function store(User $user): bool
    {
        return $user->can(config('permissions_list.IMAGE_STORE'));
    }

    public function update(User $user, Image $image): bool
    {
        $canUpdateAll = $user->can(config('permissions_list.IMAGE_UPDATE_ALL'));
        $canUpdateOwn = $user->can(config('permissions_list.IMAGE_UPDATE_OWN'));

        // If the user can't update any image but can update own image and the image being updated is not their own, return false
        if ((!$canUpdateAll && $canUpdateOwn) && $image->user_id !== $user->id) {
            return false;
        }

        return $canUpdateOwn || $canUpdateAll;
    }

    public function destroy(User $user, Image $image): bool
    {
        $canDestroyAll = $user->can(config('permissions_list.IMAGE_DESTROY_ALL'));
        $canDestroyOwn = $user->can(config('permissions_list.IMAGE_DESTROY_OWN'));

        // If the user can't destroy any image but can destroy own image and the image being destroyed is not their own, return false
        if ((!$canDestroyAll && $canDestroyOwn) && $image->user_id !== $user->id) {
            return false;
        }

        return $canDestroyOwn || $canDestroyAll;
    }
}
