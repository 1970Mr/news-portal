<?php

namespace Modules\Auth\tests\Unit;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\Auth\App\Services\RegisterService;
use Modules\User\App\Models\User;
use Tests\TestCase;

class RegisterServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_user(): void
    {
        $requestData = [
            'full_name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true,
        ];
        $request = new RegisterRequest($requestData);

        $service = new RegisterService;
        $user = $service->createUser($request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test', $user->full_name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /** @test */
    public function it_can_register_user(): void
    {
        Event::fake();

        $requestData = [
            'full_name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true,
        ];
        $request = new RegisterRequest($requestData);

        $service = new RegisterService;
        $registered = $service->register($request);

        $this->assertTrue($registered);

        Event::assertDispatched(Registered::class, static function ($event) {
            return $event->user->email === 'test@example.com';
        });
    }
}
