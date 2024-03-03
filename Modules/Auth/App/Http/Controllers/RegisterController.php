<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\Auth\App\Services\RegisterService;

class RegisterController extends Controller
{
    public function view(): View
    {
        return view('auth::register');
    }

    public function register(RegisterRequest $request, RegisterService $registerService): RedirectResponse
    {
        $success = $registerService->register($request);
        if ($success) {
            return to_route('home.index')->with('success', __('auth::messages.user_created'));
        }
        return back()->withErrors(__('auth::messages.user_not_created'));
    }
}
