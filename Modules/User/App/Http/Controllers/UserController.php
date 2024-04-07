<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\User\App\Http\Requests\UserStoreRequest;
use Modules\User\App\Http\Requests\UserUpdateRequest;
use Modules\User\App\Models\User;
use Modules\User\App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService
    )
    {
        $this->middleware('can:' . config('permissions_list.USER_INDEX'))->only('index');
        $this->middleware('can:' . config('permissions_list.USER_STORE'))->only('store');
        $this->middleware('can:' . config('permissions_list.USER_UPDATE'))->only('update');
        $this->middleware('can:' . config('permissions_list.USER_DESTROY'))->only('destroy');
    }

    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('user::index', compact('users'));
    }

    public function create(): View
    {
        return view('user::create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->userService->create($request);
        return to_route('user.index')->with('success', __('entity_created', ['entity' => __('user')]));
    }

    public function edit(User $user): View
    {
        $id = encrypt($user->id);
        return view('user::edit', compact('user', 'id'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($request, $user);
        return to_route('user.index')->with('success', __('entity_edited', ['entity' => __('user')]));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete($user);
        return to_route('user.index')->with('success', __('entity_deleted', ['entity' => __('user')]));
    }
}
