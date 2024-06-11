<?php

namespace App\Auth\Actions;

use App\Exceptions\UserCreateEditException;
use App\Http\Requests\Auth\User\CreateUserRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Actions\CreateUserAction;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Auth\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateUserRequest::factory()->create();

        Role::create(['name' => config('settings.default_role'), 'display_name' => 'User']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     * @return void
     */
    public function it_user_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $action = app(CreateUserAction::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language_id'],
            $this->request['roles'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['thumbnail'],
            $this->request['is_verified'],
        ));

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);

        $user = User::where('email', $this->request['email'])->first();
        $this->assertTrue($user->hasAllRoles($this->request['roles']));
        $this->assertNotNull($user->email_verified_at);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
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

        $action = app(CreateUserAction::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language_id']
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
    public function it_handle_user_exception_sent(): void
    {

        Exceptions::fake();

        $this->expectException(UserCreateEditException::class);

        $action = app(CreateUserAction::class);

        $action(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            null,
            $this->request['language_id'],
        ));

        Exceptions::assertReported(UserCreateEditException::class);


        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);
    }
}
