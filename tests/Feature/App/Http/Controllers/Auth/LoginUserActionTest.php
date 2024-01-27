<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Database\Factories\UserFactory;
use Domain\Auth\Actions\LoginUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\LoginUserDTO;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Domain\Auth\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class LoginUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected array $request;
    protected string $password = '123456789q';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create([
            'password' => bcrypt($this->password),
        ]);

        $this->request = [
            'email' => $this->user->email,
            'password' => $this->password,
            'session' => ''
        ];
    }

    /**
     * @test
     * @return void
     */
    public function it_login_user_success(): void
    {
        $action = app(LoginUserAction::class);

        $actionData = $action(new LoginRequest($this->request));

        dd($actionData);

        $this->assertArrayHasKey('route', $actionData);
    }

}
