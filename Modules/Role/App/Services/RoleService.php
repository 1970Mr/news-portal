<?php

namespace Modules\Role\App\Services;

use Modules\Role\App\Http\Traits\SelectedItems;
use Modules\Role\App\Models\Permission;

class RoleService
{
    use SelectedItems;

    public function groupedPermissions(): array
    {
        $permissions = Permission::all();
        return (new PermissionService)->groupedPermissions($permissions);
    }
}
