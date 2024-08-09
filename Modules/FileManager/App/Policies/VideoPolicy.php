<?php

namespace Modules\FileManager\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\FileManager\App\Models\Video;
use Modules\User\App\Models\User;

class VideoPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->canAny([
            config('permissions_list.VIDEO_INDEX_ALL'),
            config('permissions_list.VIDEO_INDEX_OWN'),
        ]);
    }

    public function all(User $user): bool
    {
        return $user->can(config('permissions_list.VIDEO_INDEX_ALL', false));
    }

    public function show(User $user, Video $video): bool
    {
        $canShowAll = $user->can(config('permissions_list.VIDEO_INDEX_ALL', false));
        $canShowOwn = $user->can(config('permissions_list.VIDEO_INDEX_OWN', false));

        // If the user can't see any video but can see own video and the video being showed is not their own, return false
        if ((! $canShowAll && $canShowOwn) && $video->user_id !== $user->id) {
            return false;
        }

        return $canShowOwn || $canShowAll;
    }

    public function store(User $user): bool
    {
        return $user->can(config('permissions_list.VIDEO_STORE', false));
    }

    public function update(User $user, Video $video): bool
    {
        $canUpdateAll = $user->can(config('permissions_list.VIDEO_UPDATE_ALL', false));
        $canUpdateOwn = $user->can(config('permissions_list.VIDEO_UPDATE_OWN', false));

        // If the user can't update any video but can update own video and the video being updated is not their own, return false
        if ((! $canUpdateAll && $canUpdateOwn) && $video->user_id !== $user->id) {
            return false;
        }

        return $canUpdateOwn || $canUpdateAll;
    }

    public function destroy(User $user, Video $video): bool
    {
        $canDestroyAll = $user->can(config('permissions_list.VIDEO_DESTROY_ALL', false));
        $canDestroyOwn = $user->can(config('permissions_list.VIDEO_DESTROY_OWN', false));

        // If the user can't destroy any video but can destroy own video and the video being destroyed is not their own, return false
        if ((! $canDestroyAll && $canDestroyOwn) && $video->user_id !== $user->id) {
            return false;
        }

        return $canDestroyOwn || $canDestroyAll;
    }

    public function operations(User $user): bool
    {
        $canAnyUpdate = $user->canAny([
            config('permissions_list.VIDEO_UPDATE_ALL'),
            config('permissions_list.VIDEO_UPDATE_OWN'),
        ]);
        $canAnyDestroy = $user->canAny([
            config('permissions_list.VIDEO_DESTROY_ALL'),
            config('permissions_list.VIDEO_DESTROY_OWN'),
        ]);

        return $canAnyUpdate || $canAnyDestroy;
    }
}
