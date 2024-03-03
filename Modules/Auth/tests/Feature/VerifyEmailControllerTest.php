<?php

namespace Modules\Auth\tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_email_verification_page(): void
    {
        $user = $this->createUser(email_verified_at: null);

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200)
            ->assertViewIs('auth::verify-email');
    }
}
