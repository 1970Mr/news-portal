<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Modules\User\App\Models\User;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_email_verification_page(): void
    {
        $user = User::factory()->active()->unverified()->create();
        $response = $this->actingAs($user)->get(route('verification.notice'));
        $response->assertStatus(200)
            ->assertViewIs('auth::verify-email');
    }

    /** @test */
    public function user_can_verify_email(): void
    {
        $user = User::factory()->active()->unverified()->create();
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

    /** @test */
    public function user_can_resend_email_verification(): void
    {
        Mail::fake();
        $user = User::factory()->active()->unverified()->create();
        $response = $this->actingAs($user)->post(route('verification.send'));
        $response->assertRedirect()
            ->assertSessionHas('success', __('auth::messages.email_verification_sent'));
    }
}
