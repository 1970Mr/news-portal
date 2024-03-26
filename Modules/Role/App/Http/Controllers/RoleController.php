<?php

namespace Modules\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Role\App\Http\Requests\RoleRequest;
use Modules\Role\App\Models\Permission;
use Modules\Role\App\Models\Role;
use Modules\Role\App\Services\PermissionService;
use Modules\Role\App\Services\RoleService;

class RoleController extends Controller
{
    public function __construct(
        public RoleService $roleService
    ) {}
    public function index(): View
    {
        $roles = Role::with('permissions')->orderBy('id', 'desc')->paginate(10);
        return view('role::index', compact('roles'));
    }

    public function create(): View
    {
        $groupedPermissions = $this->roleService->groupedPermissions();
        return view('role::create', compact('groupedPermissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->only('name'));
        return to_route('role.index')->with('success', __('entity_created', ['entity' => __('role')]));
    }

    public function edit(Role $role, PermissionService $permissionService): View
    {
        $permissions = Permission::all();
        $groupedPermissions = $permissionService->groupedPermissions($permissions);
        return view('role::edit', compact('role', 'groupedPermissions', 'permissionService'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $role->update($request->only('name'));
            $role->syncPermissions($request->permissions);
            DB::commit();
            return to_route('role.index')->with('success', __('entity_edited', ['entity' => __('role'), 'name' => $role->name]));
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return back()->with('error',  __('operation_failed'));
        }
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return to_route('role.index')->with('success', __('entity_deleted', ['entity' => __('role')]));
    }
}
