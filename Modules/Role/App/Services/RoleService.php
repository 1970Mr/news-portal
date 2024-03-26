<?php

namespace Modules\Role\App\Services;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Role\App\Models\Permission;
use Modules\Role\App\Models\Role;

class RoleService
{
    public function groupedPermissions(): array
    {
        $permissions = Permission::all();
        return (new PermissionService)->groupedPermissions($permissions);
    }

    public function createRole($request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->only('name'));
            $role->syncPermissions($request->permissions);
            DB::commit();
            return to_route('role.index')->with('success', __('entity_created', ['entity' => __('role')]));
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return back()->with('error', __('operation_failed'));
        }
    }
}
