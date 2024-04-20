<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ChangeEmailRequest;
use Modules\Profile\App\Notifications\ChangeEmailVerification;

class ChangeEmailController extends Controller
{
    public function changeEmailView(): View
    {
        $user = auth()->user();
        return view('profile::change-email', compact('user'));
    }

    public function sendChangeEmailVerification(ChangeEmailRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $url = URL::temporarySignedRoute(
            'profile.email.change.verify',
            now()->addMinutes(60),
            [
                'email' => $user->email,
                'new_email' => $request->email,
            ]
        );

        $user->notify(new ChangeEmailVerification($url));
        return to_route('profile.email.change')
            ->with('success', __('Check your email for a verification link to complete the email change.'));
    }

    public function verifyChangeEmail(Request $request): RedirectResponse
    {
        auth()->user()->update(['email' => $request->new_email]);
        return to_route('profile.email.change')->with('success', __('entity_edited', ['entity' => __('email')]));
    }
}
