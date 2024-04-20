<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ChangeEmailRequest;
use Modules\Profile\App\Services\ChangeEmailService;
use Modules\User\App\Models\User;

class ChangeEmailController extends Controller
{
    public function __construct(private readonly ChangeEmailService $changeEmailService)
    {
        $this->middleware('can:' . config('permissions_list.PROFILE_CHANGE_EMAIL', false));
    }

    public function changeEmailView(): View
    {
        $user = auth()->user();
        return view('profile::change-email', compact('user'));
    }

    public function sendChangeEmailVerification(ChangeEmailRequest $request): RedirectResponse
    {
        $this->changeEmailService->sendChangeEmailVerification($request);
        return to_route('profile.email.change')
            ->with('success', __('Check your email for a verification link to complete the email change.'));
    }

    public function verifyChangeEmail(Request $request): RedirectResponse
    {
        auth()->user()->update(['email' => $request->new_email]);
        return to_route('profile.email.change')->with('success', __('entity_edited', ['entity' => __('email')]));
    }
}
