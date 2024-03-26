<?php

namespace Modules\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Role\App\Http\Requests\RoleStoreRequest;
use Modules\Role\App\Models\Permission;
use Modules\Role\App\Models\Role;
use Modules\Role\App\Services\PermissionService;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')->latest()->paginate(10);
        return view('role::index', compact('roles'));
    }

    public function create(PermissionService $permissionService): View
    {
        $permissions = Permission::all();
        $groupedPermissions = $permissionService->groupedPermissions($permissions);
        return view('role::create', compact('groupedPermissions'));
    }

    public function store(RoleStoreRequest $request): RedirectResponse
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

    public function edit(Role $role): View
    {
        return view('role::edit');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        //
    }

    public function destroy(Role $role): RedirectResponse
    {
        //
    }
}
