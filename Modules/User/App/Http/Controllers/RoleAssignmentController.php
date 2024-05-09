<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Role\App\Models\Role;
use Modules\Role\App\Services\RoleService;
use Modules\User\App\Models\User;

class RoleAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.USER_ROLE_ASSIGNMENT', false))->only('update');
    }

    public function edit(User $user, RoleService $roleService): View
    {
        $roles = Role::latest()->get();
        return view('user::role-assignment', compact('user', 'roles', 'roleService'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->syncRoles($request->input('roles', []));
        return to_route(config('app.panel_prefix', 'panel') . '.users.index')->with('success', __('user::messages.role_assignment'));
    }
}
