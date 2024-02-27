<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Support\Facades\Session;
use Modules\User\Database\Factories\UserFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = $this->csrfToken();

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password',
            '_token' => $token,
        ]);

        $response->assertRedirect(route('home.index'));
        $this->assertAuthenticatedAs($user);
    }

    private function csrfToken(): string
    {
        Session::start();
        $token = csrf_token();
        Session::put('_token', $token);
        return $token;
    }
}
