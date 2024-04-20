<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function changePasswordView(): View
    {
        $user = auth()->user();
        return view('profile::change-password', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = auth()->user();
        if (password_verify($request->password, $user->password)) {
            $user->update([
                'password' => $request->new_password
            ]);
            return to_route('profile.password.change')->with('success', __('entity_edited', ['entity' => __('password')]));
        }
        return to_route('profile.password.change')->with('error', __('Password incorrect.'));
    }
}
