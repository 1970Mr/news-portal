<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Exceptions\IncorrectPasswordException;
use Modules\Profile\App\Http\Requests\ChangePasswordRequest;
use Modules\Profile\App\Services\ChangePasswordService;

class ChangePasswordController extends Controller
{
    public function __construct(private readonly ChangePasswordService $changePasswordService)
    {
        $this->middleware('can:' . config('permissions_list.PROFILE_CHANGE_PASSWORD', false));
    }

    public function changePasswordView(): View
    {
        $user = auth()->user();
        return view('profile::change-password', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        try {
            $this->changePasswordService->changePassword($request);
            return to_route(config('app.panel_prefix', 'panel') . '.profile.password.change')->with('success', __('entity_edited', ['entity' => __('password')]));
        } catch (IncorrectPasswordException $e) {
            return to_route(config('app.panel_prefix', 'panel') . '.profile.password.change')->with('error', $e->getMessage());
        }
    }
}
