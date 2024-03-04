<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Support\Facades\URL;
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

    /** @test */
    public function user_can_verify_email(): void
    {
        $user = UserFactory::new()->create(['email_verified_at' => null]);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())]
        );

        $response = $this->actingAs($user)->get($url);

        $response->assertRedirect(route('home.index'))
            ->assertSessionHas('success', __('auth::messages.email_verification_successfully'));

        $this->assertNotNull($user->fresh()->email_verified_at);
    }

}
