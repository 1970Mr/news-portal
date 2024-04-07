<?php

namespace Modules\Role\App\Services;

use Illuminate\Http\RedirectResponse;
use Modules\Role\App\Exceptions\UnableToRenameDefaultRoleException;
use Modules\Role\App\Http\Requests\RoleRequest;
use Modules\Role\App\Http\Traits\SelectedItems;
use Modules\Role\App\Models\Permission;
use Modules\Role\App\Models\Role;

class RoleService
{
    use SelectedItems;

    public function groupedPermissions(): array
    {
        $permissions = Permission::all();
        return (new PermissionService)->groupedPermissions($permissions);
    }

    public function update(RoleRequest $request, Role $role): bool
    {
        $defaultRoles = Role::getDefaultRoles();
        if ($defaultRoles->contains($role->name) && $role->name !== $request->get('name')) {
            throw new UnableToRenameDefaultRoleException(__('role::messages.unable_to_rename'));
        }
        return $role->update($request->only('name', 'local_name'));
    }
}
