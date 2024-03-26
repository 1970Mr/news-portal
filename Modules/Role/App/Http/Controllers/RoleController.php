<?php

namespace Modules\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Role\App\Http\Requests\RoleRequest;
use Modules\Role\App\Models\Permission;
use Modules\Role\App\Models\Role;
use Modules\Role\App\Services\PermissionService;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')->orderBy('id', 'desc')->paginate(10);
        return view('role::index', compact('roles'));
    }

    public function create(PermissionService $permissionService): View
    {
        $permissions = Permission::all();
        $groupedPermissions = $permissionService->groupedPermissions($permissions);
        return view('role::create', compact('groupedPermissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->only('name'));
            $role->syncPermissions($request->permissions);
            DB::commit();
            return to_route('role.index')->with('success', 'نقش جدید با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'مشکلی در ایجاد نقش به وجود آمد. لطفا دوباره تلاش کنید.');
        }
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
            return to_route('role.index')->with('success', "نقش {$role->name} با موفقیت ویرایش شد");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'مشکلی در ایجاد نقش به وجود آمد. لطفا دوباره تلاش کنید.');
        }
    }

    public function destroy(Role $role): RedirectResponse
    {
        $name = $role->name;
        $role->delete();
        return to_route('role.index')->with('success', "حذف $name با موفقیت انجام شد.");
    }
}
