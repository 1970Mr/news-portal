<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Session;
use Modules\User\App\Models\User;
use Modules\User\Database\Factories\UserFactory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(ThrottleRequests::class);
    }

    protected function createUser(
        $email = 'test@example.com',
        $password = 'password',
        $email_verified_at = false
    ): User
    {
        $email_verified_at = $email_verified_at === false ? now() : $email_verified_at;
        return UserFactory::new()->create([
            'email' => $email,
            'password' => bcrypt($password),
            'email_verified_at' => $email_verified_at,
        ]);
    }
}
