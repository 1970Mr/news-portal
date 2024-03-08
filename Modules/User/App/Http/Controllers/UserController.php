<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\User\App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(10);
        return view('user::index', compact('users'));
    }

    public function create(): View
    {
        return view('user::create');
    }

    public function store(Request $request): RedirectResponse
    {
        return to_route('users.index');
    }

    public function edit($id): View
    {
        return view('user::edit');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return to_route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id())
            return to_route('users.index')->withErrors('شما نمی‌توانید خودتان را حذف کنید!');
        $user->delete();
        return to_route('users.index')->with(['success' => 'حذف کاربر با موفقیت انجام شد.']);
    }
}
