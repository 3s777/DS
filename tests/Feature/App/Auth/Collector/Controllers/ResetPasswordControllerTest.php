<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Collector\LoginController;
use App\Http\Controllers\Auth\Collector\ResetPasswordController;
use Database\Factories\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $token;

    private Collector $collector;

    private string $password;

    private string $password_confirmation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collector = CollectorFactory::new()->create();
        $this->token = Password::createToken($this->collector);
        $this->password = '123456789q';
        $this->password_confirmation = '123456789q';
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([ResetPasswordController::class, 'page'], ['token' => $this->token]))
            ->assertOk()
            ->assertViewIs('content.auth-collector.reset-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {
        Password::shouldReceive('reset')
            ->once()
            ->withSomeofArgs([
                'email' => $this->collector->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ])
            ->andReturn(Password::PASSWORD_RESET);

        $response = $this->post(action([ResetPasswordController::class, 'handle']), [
            'email' => $this->collector->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token
        ]);

        $response->assertRedirect(action([LoginController::class, 'page']));
    }

    /**
     * @test
     * @return void
     */
    public function it_token_fail(): void
    {
        $response = $this->post(action([ResetPasswordController::class, 'handle']), [
            'email' => $this->collector->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => 'wrong_token'
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
