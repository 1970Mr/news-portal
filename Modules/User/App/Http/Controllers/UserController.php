<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $this->middleware('can:' . config('permissions_list.USER_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.USER_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.USER_UPDATE', false))->only('update');
        // Policy is used in destroy method
        // $this->middleware('can:' . config('permissions_list.USER_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $users = $this->userService->index($request);
        return view('user::index', compact('users'));
    }

    public function create(): View
    {
        return view('user::create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->userService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.users.index')->with('success', __('entity_created', ['entity' => __('user')]));
    }

    public function edit(User $user): View
    {
        $id = encrypt($user->id);
        return view('user::edit', compact('user', 'id'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($request, $user);
        return to_route(config('app.panel_prefix', 'panel') . '.users.index')->with('success', __('entity_edited', ['entity' => __('user')]));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete($user);
        return back()->with('success', __('entity_deleted', ['entity' => __('user')]));
    }

    public function SEOSettings(User $user): view
    {
        $nextUrl = config('app.panel_prefix', 'panel') . '.users.index';
        $title = $user->full_name;
        $pageTitle = __('user') . ' ' . $title;
        // Optional placeholders
        $canonicalUrl = route('author.index', $user->username);
        return view('seo-manager::seo-settings', compact(['nextUrl', 'title', 'canonicalUrl', 'pageTitle']) + ['model' => $user]);
    }
}
