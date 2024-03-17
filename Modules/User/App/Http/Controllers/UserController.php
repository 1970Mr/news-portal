<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\User\App\Http\Requests\UserStoreRequest;
use Modules\User\App\Http\Requests\UserUpdateRequest;
use Modules\User\App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('user::index', compact('users'));
    }

    public function create(): View
    {
        return view('user::create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
        if ($request->email_verification) $user->markEmailAsVerified();
        return to_route('users.index')->with('success', __('entity_created', ['entity' => __('user')]));
    }

    public function edit(User $user): View
    {
        $id = encrypt($user->id);
        return view('user::edit', compact('user', 'id'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        if ($request->email_verification) $user->markEmailAsVerified();
        else $user->unmarkEmailAsVerified();
        return to_route('users.index')->with('success', __('entity_edited', ['entity' => __('user'), 'name' => $request->name]));
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id())
            return to_route('users.index')->withErrors(__('user::messages.cant_delete_yourself'));
        $user->delete();
        return to_route('users.index')->with('success', __('entity_deleted', ['entity' => __('user')]));
    }
}
