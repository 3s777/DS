<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $token;

    private User $user;

    private string $password;

    private string $password_confirmation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        $this->token = Password::createToken($this->user);
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
            ->assertViewIs('content.auth.reset-password');
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
                'email' => $this->user->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ])
            ->andReturn(Password::PASSWORD_RESET);

        $response = $this->post(action([ResetPasswordController::class, 'handle']), [
            'email' => $this->user->email,
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
            'email' => $this->user->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => 'wrong_token'
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
