<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\App\Models\User;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_logout(): void
    {
        $user = User::factory()->create([
            'password' => 'password'
        ]);
        $this->actingAs($user);
        $response = $this->post(route('logout'));
        $response->assertRedirect(route('home.index'));
        $this->assertGuest();
    }
}
