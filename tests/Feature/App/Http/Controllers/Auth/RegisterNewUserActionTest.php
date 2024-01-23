<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Notifications\VerifyEmailNotification;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterRequest::factory()->create();

        $this->action = app(RegisterNewUserContract::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_user_created_success(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $action = app(RegisterNewUserContract::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password']
        ));

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_registered_event_and_listeners_dispatched(): void
    {
        Event::fake();

        $action = app(RegisterNewUserContract::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password']
        ));

        Event::assertDispatched(Registered::class);
        Event::assertListening(
            Registered::class,
            SendEmailVerificationNotification::class
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_notification_sent(): void
    {
        $action = app(RegisterNewUserContract::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password']
        ));

        $user = User::where('email', $this->request['email'])->first();

        Notification::assertSentTo(
            $user,
            VerifyEmailNotification::class
        );
    }
}
