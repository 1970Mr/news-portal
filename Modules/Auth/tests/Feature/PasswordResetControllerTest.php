<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Support\Facades\Password;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_request_password_reset_link(): void
    {
        $this->createUser();

        Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn(Password::RESET_LINK_SENT);

        $response = $this->post(route('password.email'), [
            'email' => 'test@example.com',
            '_token' => $this->csrfToken(),
        ]);

        $response->assertRedirect()
            ->assertSessionHas('success');
    }
}
