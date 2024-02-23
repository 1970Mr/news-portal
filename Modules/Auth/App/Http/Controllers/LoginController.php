<?php

namespace Modules\Auth\App\Http\Controllers;

use Modules\Share\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Auth\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function view(): View
    {
        return view('auth::login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (auth()->attempt($request->all(['email', 'password']), !empty($request->get('remember-me'))) ) {
            return to_route('home.index')->with('success', __('ورود با موفقیت انجام شد'));
        }
        return back()->with('error', __('کاربری با مشخصات وارد شده یافت نشد'));
    }
}
