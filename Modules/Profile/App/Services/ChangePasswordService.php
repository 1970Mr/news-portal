<?php

namespace Modules\Profile\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Profile\App\Exceptions\IncorrectPasswordException;
use Modules\Profile\App\Http\Requests\ChangePasswordRequest;

class ChangePasswordService
{
    public function __construct(private readonly Model $user) {}

    public function changePassword(ChangePasswordRequest $request): bool
    {
        if (password_verify($request->password, $this->user->password)) {
            return $this->user->update([
                'password' => $request->new_password
            ]);
        }
        throw new IncorrectPasswordException(__('Password incorrect.'));
    }
}
