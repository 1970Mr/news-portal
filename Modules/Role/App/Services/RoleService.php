<?php

namespace Modules\Role\App\Services;

use Illuminate\Http\RedirectResponse;
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

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $default_roles = Role::getDefaultRoles();
        if($default_roles->contains($role->name) && $role->name !== $request->get('name')) {
            return back()->with('error', __('role::messages.unable_to_rename'));
        }
        $role->update($request->only('name', 'local_name'));
        return to_route('role.index')->with('success', __('entity_edited', ['entity' => __('role'), 'name' => $role->local_name]));
    }
}
