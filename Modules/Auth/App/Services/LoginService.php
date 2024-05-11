<?php

namespace Modules\Auth\App\Services;

use Modules\Auth\App\Exceptions\FailedLoginException;
use Modules\Auth\App\Http\Requests\LoginRequest;

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
            return true;
        }
        throw new FailedLoginException(__('auth::messages.login_failed'));
    }

    public function checkUserIsEnable(): void
    {
        if (!auth()->user()->status) {
            auth()->logout();
            throw new FailedLoginException(__('auth::messages.account_disabled'));
        }
    }
}
