<?php

namespace Modules\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Role\App\Http\Requests\RoleRequest;
use Modules\Role\App\Models\Role;
use Modules\Role\App\Services\PermissionService;
use Modules\Role\App\Services\RoleService;

class RoleController extends Controller
{
    private array $groupedPermissions;

    public function __construct(
        private readonly RoleService $roleService
    )
    {
        $this->groupedPermissions = $this->roleService->groupedPermissions();
        $this->middleware('can:role::index')->only('index');
        $this->middleware('can:role::store')->only('store');
        $this->middleware('can:role::update')->only('update');
        $this->middleware('can:role::destroy')->only('destroy');
    }

    public function index(): View
    {
        $roles = Role::with('permissions')->latest('id')->paginate(10);
        return view('role::index', compact('roles'));
    }

    public function create(): View
    {
        return view('role::create', ['groupedPermissions' => $this->groupedPermissions]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->only('name', 'local_name'));
        return to_route('role.index')->with('success', __('entity_created', ['entity' => __('role')]));
    }

    public function edit(Role $role, PermissionService $permissionService): View
    {
        return view('role::edit', compact('role', 'permissionService') + ['groupedPermissions' => $this->groupedPermissions]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->only('name', 'local_name'));
        return to_route('role.index')->with('success', __('entity_edited', ['entity' => __('role'), 'name' => $role->local_name]));
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return to_route('role.index')->with('success', __('entity_deleted', ['entity' => __('role')]));
    }
}
