<?php

namespace App\Auth\Admin\Actions;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Actions\CreateAdminAction;
use Domain\Auth\Actions\UpdateAdminAction;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\DTOs\UpdateAdminDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateAdminActionTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateAdminRequest::factory()->create();

        Role::create(['name' => config('settings.default_role'), 'display_name' => 'User']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);

        $this->withoutExceptionHandling();
    }

    public function test_user_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');
        Event::fake([
            Verified::class
        ]);

        $createAction = app(CreateAdminAction::class);

        $createAction(NewAdminDTO::make(
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
        Role::create(['name' => 'superadmin', 'display_name' => 'Super Admin']);
        $role = Role::where('name', config('settings.default_role'))->first();
        $role->givePermissionTo('entity.*');

        $updateAction = app(UpdateAdminAction::class);

        $updateAction(UpdateAdminDTO::make(
            'newName',
            'newEmail@email.com',
            $this->request['language'],
            ['user', 'superadmin'],
            ['test'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            UploadedFile::fake()->image('photo2.doc'),
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

    /**
     * @throws UserCreateEditException
     */
    public function test_handle_user_exception_sent(): void
    {

        $createAction = app(CreateAdminAction::class);

        $createAction(NewAdminDTO::make(
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

        $admin = User::where('email', $this->request['email'])->first();

        $action = app(UpdateAdminAction::class);

        $this->assertThrows(
            fn () => (
            $action(UpdateAdminDTO::make(
                $this->request['name'],
                'wrong email',
                $this->request['language'],
                ['wrong_role']
            ), $admin)),
            UserCreateEditException::class
        );


        $this->assertDatabaseMissing('users', [
            'email' => 'wrong email'
        ]);
    }
}
