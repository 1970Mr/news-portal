<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Database\Factories\UserFactory;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_login_form(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200)
            ->assertViewIs('auth::login')
            ->assertSee('ورود');
    }

    /** @test */
    public function user_can_login_with_valid_credentials(): void
    {
        $user = UserFactory::new()->create();

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home.index'))
            ->assertSessionHas('success',  __('auth::messages.login_success'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials(): void
    {
        UserFactory::new()->create();

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password2',
        ]);

        $response->assertSessionHasErrors()
            ->assertSessionHasErrors();

        $this->assertGuest();
    }
}
