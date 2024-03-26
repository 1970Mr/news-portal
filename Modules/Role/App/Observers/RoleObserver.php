<?php

namespace Modules\Role\App\Observers;

use Illuminate\Support\Facades\Request;
use Modules\Role\App\Models\Role;

class RoleObserver
{
    public function created(Role $role): void
    {
        $role->syncPermissions(Request::input('permissions', []));
    }

    public function updated(Role $role): void
    {
        $role->syncPermissions(Request::input('permissions', []));
    }
}
