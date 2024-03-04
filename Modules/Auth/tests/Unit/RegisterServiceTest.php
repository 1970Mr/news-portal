<?php

namespace Modules\Auth\tests\Unit;

use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\Auth\App\Services\RegisterService;
use Modules\User\App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_user(): void
    {
        $requestData = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true,
        ];
        $request = new RegisterRequest($requestData);

        $service = new RegisterService();
        $user = $service->createUser($request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
    }
}
