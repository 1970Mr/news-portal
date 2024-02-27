<?php

namespace Modules\Auth\tests\Feature;

use Modules\User\Database\Factories\UserFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_logout(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->actingAs($user);
        $response = $this->post(route('logout'), ['_token' => $this->csrfToken()]);
        $response->assertRedirect(route('home.index'));
        $this->assertGuest();
    }
}
