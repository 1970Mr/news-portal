<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Modules\Auth\App\Http\Requests\PasswordResetRequest;
use Modules\Auth\App\Http\Requests\SendEmailRequest;
use Modules\Auth\App\Services\PasswordResetService;

class PasswordResetController extends Controller
{
    public function showForgotForm(): View
    {
        return view('auth::password.forgot');
    }

    public function sendResetLink(SendEmailRequest $request): RedirectResponse
    {
        $reset_link_sent = Password::sendResetLink($request->only('email'));

        return $reset_link_sent === Password::RESET_LINK_SENT ?
            back()->with('success', __('auth::messages.password_link_sent_success')) :
            back()->withErrors(__('auth::messages.password_link_sent_failed'));
    }

    public function showResetForm(Request $request, string $token): View|RedirectResponse
    {
        return $request->has('email') && $token ?
            view('auth::password.reset', ['email' => $request->get('email'), 'token' => $token]) :
            to_route('password.request')->withErrors(__('auth::messages.reset_link_invalid'));
    }

    public function update(PasswordResetRequest $request, PasswordResetService $passwordResetService): RedirectResponse
    {
        $status = $passwordResetService->passwordReset($request);

        return $status === Password::PASSWORD_RESET ?
            to_route('login')->with('success', __('auth::messages.password_changed_successfully')) :
            to_route('password.request')->withErrors(__('auth::messages.password_change_failed'));
    }
}
