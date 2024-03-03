<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Session;
use Modules\User\App\Models\User;
use Modules\User\Database\Factories\UserFactory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(\Illuminate\Routing\Middleware\ThrottleRequests::class);
    }

    protected function csrfToken(): string
    {
        Session::start();
        $token = csrf_token();
        Session::put('_token', $token);
        return $token;
    }

    protected function createUser(
        $email = 'test@example.com',
        $password = 'password'
    ): User
    {
        return UserFactory::new()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
