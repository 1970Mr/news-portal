<?php

namespace Modules\Auth\tests\Feature;

use Modules\User\Database\Factories\UserFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function user_can_view_email_verification_page(): void
    {
        $user = UserFactory::new()->create(['email_verified_at' => null]);

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200)
            ->assertViewIs('auth::verify-email');
    }


}
