<?php

namespace Modules\Role\App\Services;

use Modules\Role\App\Models\Permission;

class RoleService
{
    public function groupedPermissions(): array
    {
        $permissions = Permission::all();
        return (new PermissionService)->groupedPermissions($permissions);
    }
}
