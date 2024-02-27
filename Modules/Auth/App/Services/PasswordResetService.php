<?php

namespace Modules\Auth\App\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Auth\App\Http\Requests\PasswordResetRequest;
use Modules\User\App\Models\User;

class PasswordResetService
{
    public function passwordReset(PasswordResetRequest $request): string
    {
        return Password::reset(
            $request->validated(),
            static function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
