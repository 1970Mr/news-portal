<?php

namespace Modules\Auth\tests\Unit;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Modules\Auth\App\Http\Requests\PasswordResetRequest;
use Modules\Auth\App\Services\PasswordResetService;
use Modules\User\App\Models\User;
use Modules\User\Database\Factories\UserFactory;
use Tests\TestCase;

class PasswordResetServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_reset_user_password(): void
    {
        Event::fake();

        $user = User::factory()->create();
        $token = Password::createToken($user);
        $requestData = [
            'token' =>  $token,
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ];
        $request = new PasswordResetRequest($requestData);

        $passwordResetService = new PasswordResetService();
        $status = $passwordResetService->passwordReset($request);

        $this->assertEquals(Password::PASSWORD_RESET, $status);
        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));

        $this->assertNotNull($user->fresh()->getRememberToken());

        Event::assertDispatched(PasswordReset::class, static function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
