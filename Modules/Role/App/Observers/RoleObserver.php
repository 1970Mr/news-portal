<?php

namespace Modules\Role\App\Observers;

use Modules\Role\App\Models\Role;

class RoleObserver
{
    public function created(Role $role): void
    {
        $role->syncPermissions(request()->input('permissions', []));
    }
}
