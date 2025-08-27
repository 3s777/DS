<?php

namespace App\Auth\Collector\Actions;

use App\Http\Requests\Auth\Admin\CreateCollectorRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Actions\CreateCollectorAction;
use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCollectorActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('images');

        $this->request = CreateCollectorRequest::factory()->create();

        Role::create([
            'name' => config('settings.default_collector_role'),
            'display_name' => 'collector',
            'guard_name' => 'collector'
        ]);

        $this->withoutExceptionHandling();
    }

    /**
     * @throws UserCreateEditException
     */
    public function test_user_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('collectors', [
            'email' => $this->request['email']
        ]);

        $action = app(CreateCollectorAction::class);

        $action(NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['featured_image'],
            $this->request['is_verified'],
        ));

        $this->assertDatabaseHas('collectors', [
            'email' => $this->request['email']
        ]);

        $collector = Collector::where('email', $this->request['email'])->first();
        $this->assertTrue($collector->hasAllRoles($this->request['roles']));
        $this->assertNotNull($collector->email_verified_at);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @throws UserCreateEditException
     */
    public function test_registered_event_and_listeners_dispatched(): void
    {
        Event::fake([
            Registered::class,
            Verified::class
        ]);

        $action = app(CreateCollectorAction::class);

        $action(NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['featured_image'],
            $this->request['is_verified'],
        ));

        Event::assertDispatched(Registered::class);
        Event::assertListening(
            Registered::class,
            SendEmailVerificationNotification::class
        );
        Event::assertDispatched(Verified::class);
    }

    public function test_handle_user_exception_sent(): void
    {

        $action = app(CreateCollectorAction::class);

        $this->assertThrows(
            fn () => (
            $action(NewCollectorDTO::make(
                $this->request['name'],
                $this->request['email'],
                'password',
                $this->request['language'],
                roles: ['wrong_role']
            ))),
            UserCreateEditException::class
        );


        $this->assertDatabaseMissing('collectors', [
            'email' => $this->request['email'],
        ]);
    }
}
