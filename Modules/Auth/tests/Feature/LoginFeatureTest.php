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
    public function user_can_view_login_form(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('وارد شوید');
    }

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

    /** @test */
    public function user_cannot_login_with_invalid_credentials(): void
    {
        UserFactory::new()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = $this->csrfToken();
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password2',
            '_token' => $token,
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    private function csrfToken(): string
    {
        Session::start();
        $token = csrf_token();
        Session::put('_token', $token);
        return $token;
    }
}
