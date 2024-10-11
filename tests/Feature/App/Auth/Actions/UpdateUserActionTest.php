<?php

namespace App\Auth\Actions;

use App\Http\Requests\Auth\User\CreateUserRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Actions\CreateUserAction;
use Domain\Auth\Actions\UpdateUserAction;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
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
        Event::fake([
            Verified::class
        ]);

        $createAction = app(CreateUserAction::class);

        $createAction(NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            null,
            null,
        ));

        $user = User::where('email', $this->request['email'])->first();

        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);

        Permission::create(['name' => 'test', 'display_name' => 'Test']);
        Role::create(['name' => 'superadmin', 'display_name' =>'Super Admin']);
        $role = Role::where('name', config('settings.default_role'))->first();
        $role->givePermissionTo('entity.*');

        $updateAction = app(UpdateUserAction::class);

        $updateAction(UpdateUserDTO::make(
            'newName',
            'newEmail@email.com',
            $this->request['language'],
            ['user', 'superadmin'],
            ['test'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            UploadedFile::fake()->image('photo2.php'),
            null,
            $this->request['is_verified'],
        ), $user);

        $this->assertDatabaseHas('users', [
            'email' => 'newEmail@email.com',
        ]);

        $updatedUser = User::where('email', 'newEmail@email.com')->first();

        $this->assertTrue($updatedUser->hasAllPermissions(['entity.edit', 'entity.delete', 'test']));
        $this->assertTrue($updatedUser->hasAllRoles([config('settings.default_role'), 'superadmin']));
        $this->assertFalse($updatedUser->hasRole('editor'));

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);

        Event::assertDispatched(Verified::class);
    }

//    TODO test exception without HTTP
}
