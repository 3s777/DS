<?php

namespace App\Auth\Admin\Actions;

use Database\Factories\Auth\UserFactory;
use Domain\Auth\Actions\LoginAdminAction;
use Domain\Auth\DTOs\LoginAdminDTO;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginAdminActionTest extends TestCase
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

    public function test_login_user_success(): void
    {
        $action = app(LoginAdminAction::class);

        $actionData = $action(LoginAdminDTO::make(
            $this->user->email,
            $this->password,
        ));

        $this->assertArrayNotHasKey('not_verified', $actionData);
    }

    public function test_login_user_password_fail(): void
    {
        $action = app(LoginAdminAction::class);

        $actionData = $action(LoginAdminDTO::make(
            $this->user->email,
            str()->random(10),
        ));

        $this->assertArrayHasKey('error', $actionData);
    }

    public function test_login_user_remember_success(): void
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
