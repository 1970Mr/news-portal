<?php

namespace Modules\Profile\App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\URL;
use Modules\Profile\App\Http\Requests\ChangeEmailRequest;
use Modules\Profile\App\Notifications\ChangeEmailVerification;

class ChangeEmailService
{
    public function sendChangeEmailVerification(ChangeEmailRequest $request): void
    {
        $user = auth()->user();
        $url = $this->createChangeEmailUrl($request, $user);
        $user->notify(new ChangeEmailVerification($url));
    }

    public function createChangeEmailUrl(ChangeEmailRequest $request, Authenticatable $user): string
    {
        return URL::temporarySignedRoute(
            config('app.panel_prefix', 'panel') . '.profile.email.change.verify',
            now()->addMinutes(60),
            [
                'email' => $user->email,
                'new_email' => $request->email,
            ]
        );
    }
}
