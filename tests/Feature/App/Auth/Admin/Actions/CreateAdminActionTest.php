<?php

namespace App\Auth\Admin\Actions;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Domain\Auth\Actions\CreateAdminAction;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateAdminActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('images');

        $this->request = CreateAdminRequest::factory()->create();

        Role::create(['name' => config('settings.default_role'), 'display_name' => 'User']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);

        $this->withoutExceptionHandling();
    }

    public function testUserCreatedSuccess(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $action = app(CreateAdminAction::class);

        $action(NewAdminDTO::make(
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

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);

        $user = User::where('email', $this->request['email'])->first();
        $this->assertTrue($user->hasAllRoles($this->request['roles']));
        $this->assertNotNull($user->email_verified_at);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function testRegisteredEventAndListenersDispatched(): void
    {
        Event::fake([
            Registered::class,
            Verified::class
        ]);

        $action = app(CreateAdminAction::class);

        $action(NewAdminDTO::make(
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
//        Exceptions::fake();
//
//        $this->expectException(UserCreateEditException::class);

        $action = app(CreateAdminAction::class);

        $this->assertThrows(
            fn () => (
            $action(NewAdminDTO::make(
                $this->request['name'],
                $this->request['email'],
                'password',
                $this->request['language'],
                roles: ['wrong_role']
            ))),
            UserCreateEditException::class
        );

//        $action(NewAdminDTO::make(
//            $this->request['name'],
//            'wrong email',
//            'password',
//            $this->request['language'],
//            roles: ['wrong_role']
//        ));
//
//        Exceptions::assertReported(UserCreateEditException::class);

        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email'],
        ]);
    }
}
