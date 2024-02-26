<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerifyEmailController extends Controller
{
    public function view(): View
    {
        return view('auth::verify-email');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return to_route('home.index')->with('success', __('ایمیل شما با موفقیت تایید شد.'));
    }

    public function send(): RedirectResponse
    {
        auth()->user()->sendEmailVerificationNotification();
        return back()->with('success', __('لینک تایید برای ایمیل شما ارسال شد.'));
    }
}
