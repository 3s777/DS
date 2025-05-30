<?php

namespace App\Auth\Admin\Actions;

use App\Http\Requests\Auth\Public\RegisterAdminRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Auth\Notifications\VerifyEmailAdminNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterNewAdminActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterAdminRequest::factory()->create();

        $this->action = app(RegisterNewUserContract::class);

        Role::create(['name' => config('settings.default_role'), 'display_name' => 'User']);
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

        $action(NewAdminDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
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
        Event::fake([
            Registered::class,
        ]);

        $action = app(RegisterNewUserContract::class);

        $action(NewAdminDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
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

        $action(NewAdminDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
        ));

        $user = User::where('email', $this->request['email'])->first();

        Notification::assertSentTo(
            $user,
            VerifyEmailAdminNotification::class
        );
    }
}
