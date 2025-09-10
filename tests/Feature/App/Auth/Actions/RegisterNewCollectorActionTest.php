<?php

namespace App\Auth\Actions;

use App\Http\Requests\Auth\Public\RegisterCollectorRequest;
use Domain\Auth\Actions\RegisterNewCollectorAction;
use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Auth\Notifications\VerifyEmailCollectorNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterNewCollectorActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterCollectorRequest::factory()->create();

        Role::create([
            'name' => config('settings.default_collector_role'),
            'display_name' => 'collector',
            'guard_name' => 'collector'
        ]);
    }

    public function test_collector_created_success(): void
    {
        $this->assertDatabaseMissing('collectors', [
            'email' => $this->request['email']
        ]);

        $action = app(RegisterNewCollectorAction::class);

        $action(NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
        ));

        $this->assertDatabaseHas('collectors', [
            'email' => $this->request['email']
        ]);
    }

    public function test_registered_event_and_listeners_dispatched(): void
    {
        Event::fake([
            Registered::class,
        ]);

        $action = app(RegisterNewCollectorAction::class);

        $action(NewCollectorDTO::make(
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

    public function test_notification_sent(): void
    {
        $action = app(RegisterNewCollectorAction::class);

        $action(NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
        ));

        $collector = Collector::where('email', $this->request['email'])->first();

        Notification::assertSentTo(
            $collector,
            VerifyEmailCollectorNotification::class
        );
    }
}
