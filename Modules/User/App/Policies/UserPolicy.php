<?php

namespace Modules\User\App\Policies;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $loggedInUser, User $userToDelete): bool
    {
        if ($loggedInUser->id === $userToDelete->id) {
            throw new AuthorizationException(__('user::messages.cant_delete_yourself'));
        }

        return $loggedInUser->can(config('permissions_list.USER_DESTROY', false));
    }
}
