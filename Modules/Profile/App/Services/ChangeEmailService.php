<?php

namespace Modules\Profile\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Modules\Profile\App\Http\Requests\ChangeEmailRequest;
use Modules\Profile\App\Notifications\ChangeEmailVerification;

class ChangeEmailService
{
    public function __construct(private readonly Model $user) {}

    public function sendChangeEmailVerification(ChangeEmailRequest $request): void
    {
        $url = $this->createChangeEmailUrl($request);
        $this->user->notify(new ChangeEmailVerification($url));
    }

    public function createChangeEmailUrl(ChangeEmailRequest $request): string
    {
        return URL::temporarySignedRoute(
            'profile.email.change.verify',
            now()->addMinutes(60),
            [
                'email' => $this->user->email,
                'new_email' => $request->email,
            ]
        );
    }
}
