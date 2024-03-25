<?php

namespace Modules\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Role\App\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')->latest()->paginate(10);
        return view('role::index', compact('roles'));
    }

    public function create(): View
    {
        return view('role::create');
    }

    public function store(Request $request): RedirectResponse
    {
        //
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
