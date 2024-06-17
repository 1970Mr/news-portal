<?php

namespace Modules\Auth\App\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Exceptions\FailedLoginException;
use Modules\Auth\App\Http\Requests\LoginRequest;
use Modules\UserActivity\App\Services\TrackUserRequestService;

class LoginService
{
    /**
     * @throws FailedLoginException
     */
    public function login(LoginRequest $request): bool
    {
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->has('remember-me');
        if (auth()->attempt($credentials, $rememberMe) ) {
            $this->checkUserIsEnable();
            $this->setUserTracking($request);
            return true;
        }
        throw new FailedLoginException(__('auth::messages.login_failed'));
    }

    public function checkUserIsEnable(): void
    {
        if (!Auth::user()->status) {
            auth()->logout();
            throw new FailedLoginException(__('auth::messages.account_disabled'));
        }
    }

    public function setUserTracking(LoginRequest $request): void
    {
        $trackService = new TrackUserRequestService($request, Auth::user());
        $trackService->setUserTracking();
    }
}
