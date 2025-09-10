<?php

namespace App\Auth\Actions;

use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Actions\LoginCollectorAction;
use Domain\Auth\DTOs\LoginCollectorDTO;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginCollectorActionTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $collector;
    protected string $password = '123456789q';

    protected function setUp(): void
    {
        parent::setUp();

        $this->collector = CollectorFactory::new()->create([
            'password' => bcrypt($this->password),
            'remember_token' => null
        ]);
    }

    public function test_login_collector_success(): void
    {
        $action = app(LoginCollectorAction::class);

        $actionData = $action(LoginCollectorDTO::make(
            $this->collector->email,
            $this->password,
        ));

        $this->assertArrayNotHasKey('not_verified', $actionData);
    }

    public function test_login_collector_password_fail(): void
    {
        $action = app(LoginCollectorAction::class);

        $actionData = $action(LoginCollectorDTO::make(
            $this->collector->email,
            str()->random(10),
        ));

        $this->assertArrayHasKey('error', $actionData);
    }

    public function test_login_user_remember_success(): void
    {
        $action = app(LoginCollectorAction::class);

        $actionData = $action(LoginCollectorDTO::make(
            $this->collector->email,
            $this->password,
            true
        ));

        $this->assertDatabaseMissing('users', [
            'email' => $this->collector->email,
            'remember_token' => null
        ]);
    }
}
