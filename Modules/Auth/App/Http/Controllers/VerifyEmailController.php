<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Auth\App\Services\VerifyEmailService;
use Modules\User\Models\User;

class VerifyEmailController extends Controller
{
    public function view(): View
    {
        return view('auth::verify-email');
    }

    public function verify(EmailVerificationRequest $request, VerifyEmailService $verifyEmailService): RedirectResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return to_route('home.index')->with($verifyEmailService->message('info'));
        }
        $request->fulfill();
        return to_route('home.index')->with($verifyEmailService->message('success', 'ایمیل شما با موفقیت تایید شد.'));
    }

    public function send(VerifyEmailService $verifyEmailService): RedirectResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return back()->with($verifyEmailService->message('info'));
        }
        auth()->user()->sendEmailVerificationNotification();
        return back()->with($verifyEmailService->message('success'));
    }
}
