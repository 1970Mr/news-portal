<?php

namespace Modules\Auth\tests\Feature;

use Mockery\MockInterface;
use Modules\Auth\App\Services\RegisterService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_show_register_form(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200)
            ->assertViewIs('auth::register')
            ->assertSee('ثبت نام');
    }

    /** @test */
    public function register_service_works(): void
    {
        $this->instance(
            RegisterService::class,
            mock(RegisterService::class, static function (MockInterface $mock) {
                $mock->shouldReceive('register')
                    ->once()
                    ->andReturn(true);
            })
        );

        $requestData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true,
        ];
        $this->post(route('register'), $requestData);
    }

    /** @test */
    public function user_can_register_with_valid_data(): void
    {
        $requestData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true,
        ];

        $response = $this->post(route('register'), $requestData);

        $response->assertRedirect(route('home.index'))
            ->assertSessionHas('success', __('auth::messages.user_created'));

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }
}
