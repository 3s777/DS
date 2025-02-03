<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\Admin\UserController;
use App\Http\Requests\Auth\User\CreateUserRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\UserFactory;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $authUser;
    protected User $testingUser;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->authUser = UserFactory::new()->create();

        $this->testingUser = UserFactory::new()->create();

        $this->request = CreateUserRequest::factory()->create();

        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);

        Role::create(['name' => 'user', 'display_name' => 'User']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([UserController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->authUser->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->authUser->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->authUser->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->authUser->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([UserController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.list'))
            ->assertViewIs('admin.user.user.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([UserController::class, 'create']))
            ->assertOk()
            ->assertSee(__('user.add'))
            ->assertViewIs('admin.user.user.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([UserController::class, 'edit'], [$this->testingUser->slug]))
            ->assertOk()
            ->assertSee($this->testingUser->name)
            ->assertViewIs('admin.user.user.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->actingAs($this->authUser)
            ->post(action([UserController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.users.index')
            ->assertSessionHas('helper_flash_message', __('user.created'));

        $user = User::where('name', $this->request['name'])->first();
        $this->assertTrue($user->hasAllRoles($this->request['roles']));
        $this->assertNotNull($user->email_verified_at);

        $this->assertDatabaseHas('users', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        Permission::create(['name' => 'test', 'display_name' => 'Test']);
        Role::create(['name' => 'superadmin', 'display_name' =>'Super Admin']);
        $role = Role::where('name', config('settings.default_role'))->first();
        $role->givePermissionTo('entity.*');

        $this->request['name'] = 'newName';
        $this->request['first_name'] = 'New First Name';
        $this->request['roles'] = ['user', 'superadmin'];
        $this->request['permissions'] = ['test'];

        $this->actingAs($this->authUser)
            ->put(
                action(
                    [UserController::class, 'update'],
                    [$this->testingUser->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.users.index')
            ->assertSessionHas('helper_flash_message', __('user.updated'));

        $user = User::where('name', 'newname')->first();
        $this->assertTrue($user->hasAllPermissions(['entity.edit', 'entity.delete', 'test']));
        $this->assertTrue($user->hasAllRoles([config('settings.default_role'), 'superadmin']));
        $this->assertFalse($user->hasRole('editor'));

        $this->assertDatabaseHas('users', [
            'name' => 'newname',
            'first_name' => 'New First Name'
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->authUser)
            ->delete(action([UserController::class, 'destroy'], [$this->testingUser->slug]))
            ->assertRedirectToRoute('admin.users.index')
            ->assertSessionHas('helper_flash_message', __('user.deleted'));

        $this->assertDatabaseMissing('users', [
            'name' => $this->testingUser->name,
            'deleted_at' => null
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_has_wildcard_permissions_via_role_success(): void
    {
        $role = Role::where('name', config('settings.default_role'))->first();

        $role->givePermissionTo('entity.*');

        $this->actingAs($this->authUser)
            ->post(action([UserController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.users.index')
            ->assertSessionHas('helper_flash_message', __('user.created'));

        $user = User::where('name', $this->request['name'])->first();
        $this->assertTrue($user->hasAllPermissions(['entity.create', 'entity.edit', 'entity.delete']));
    }

    /**
     * @test
     * @return void
     */
    public function it_create_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.users.create'));

        $this->request['name'] = '';
        $this->request['password'] = 'wrong';
        $this->request['language'] = 'test';
        $this->request['roles'] = ['role.not-exist'];
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->authUser)
            ->post(action([UserController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'password', 'language', 'roles', 'featured_image'])
            ->assertRedirectToRoute('admin.users.create');

        $this->assertDatabaseMissing('users', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.users.edit', [$this->testingUser->slug]));

        $this->request['name'] = '';
        $this->request['language'] = 'test';
        $this->request['roles'] = ['role.not-exist'];
        $this->request['permissions'] = ['permission.not-exist'];

        $this->actingAs($this->authUser)
            ->put(
                action(
                    [UserController::class, 'update'],
                    [$this->testingUser->slug]
                ),
                $this->request
            )
            ->assertInvalid(['name', 'language', 'roles', 'permissions'])
            ->assertRedirectToRoute('admin.users.edit', [$this->testingUser->slug]);

        $this->assertDatabaseMissing('users', [
            'name' => $this->request['name']
        ]);
    }
}
