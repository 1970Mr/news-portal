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
}
