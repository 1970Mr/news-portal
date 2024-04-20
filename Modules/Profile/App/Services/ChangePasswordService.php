<?php

namespace Modules\Profile\App\Services;

use Modules\Profile\App\Exceptions\IncorrectPasswordException;
use Modules\Profile\App\Http\Requests\ChangePasswordRequest;

class ChangePasswordService
{
    public function changePassword(ChangePasswordRequest $request): bool
    {
        $user = auth()->user();
        if (password_verify($request->password, $user->password)) {
            return $user->update([
                'password' => $request->new_password
            ]);
        }
        throw new IncorrectPasswordException(__('Password incorrect.'));
    }
}
