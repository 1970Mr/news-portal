<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Exceptions\IncorrectPasswordException;
use Modules\Profile\App\Http\Requests\ChangePasswordRequest;
use Modules\Profile\App\Services\ChangePasswordService;
use Modules\User\App\Models\User;

class ChangePasswordController extends Controller
{
    private Model $user;

    public function __construct(private readonly ChangePasswordService $changePasswordService) {
        $this->user = User::query()->find(auth()->id());
    }

    public function changePasswordView(): View
    {
        return view('profile::change-password', ['user' => $this->user]);
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        try {
            $this->changePasswordService->changePassword($request);
            return to_route('profile.password.change')->with('success', __('entity_edited', ['entity' => __('password')]));
        } catch (IncorrectPasswordException $e) {
            return to_route('profile.password.change')->with('error', $e->getMessage());
        }
    }
}
