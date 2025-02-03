<?php

namespace App\Auth\Actions;

use Database\Factories\UserFactory;
use Domain\Auth\Actions\LoginAdminAction;
use Domain\Auth\DTOs\LoginAdminDTO;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected string $password = '123456789q';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create([
            'password' => bcrypt($this->password),
            'remember_token' => null
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_login_user_success(): void
    {
        $action = app(LoginAdminAction::class);

        $actionData = $action(LoginAdminDTO::make(
            $this->user->email,
            $this->password,
        ));

        $this->assertArrayNotHasKey('not_verified', $actionData);
    }

    /**
     * @test
     * @return void
     */
    public function it_login_user_password_fail(): void
    {
        $action = app(LoginAdminAction::class);

        $actionData = $action(LoginAdminDTO::make(
            $this->user->email,
            str()->random(10),
        ));

        $this->assertArrayHasKey('error', $actionData);
    }

    /**
     * @test
     * @return void
     */
    public function it_login_user_remember_success(): void
    {
        $action = app(LoginAdminAction::class);

        $actionData = $action(LoginAdminDTO::make(
            $this->user->email,
            $this->password,
            true
        ));

        $this->assertDatabaseMissing('users', [
            'email' => $this->user->email,
            'remember_token' => null
        ]);
    }
}
