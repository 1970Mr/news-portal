<?php

namespace Modules\User\App\Observers;

use Modules\Role\App\Models\Role;
use Modules\User\App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->syncRoles(Role::SUBSCRIBER);
    }
}
