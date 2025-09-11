<?php

namespace Admin\Auth\Controllers;

use App\Admin\Http\Controllers\Auth\AdminController;
use App\Admin\Http\Controllers\Auth\CollectorController;
use App\Admin\Http\Requests\Auth\CreateCollectorRequest;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Database\Factories\Auth\CollectorFactory;
use Database\Factories\Auth\UserFactory;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class CollectorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $authUser;
    protected Collector $testingCollector;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('images');

        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->authUser = UserFactory::new()->create();

        $this->testingCollector = CollectorFactory::new()->create();

        $this->request = CreateCollectorRequest::factory()->create();

        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);

        Role::create(['name' => 'user', 'display_name' => 'User']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);
        Role::create(['name' => 'super_admin', 'display_name' => 'SuperAdmin']);

        Role::create(['name' => 'collector', 'display_name' => 'Collector', 'guard_name' => 'collector']);
        Permission::create(['name' => 'entity.*', 'display_name' => 'Entity', 'guard_name' => 'collector']);

        $this->authUser->assignRole('super_admin');
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([AdminController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('show', 'get', [$this->authUser->slug]);
        $this->checkNotAuthRedirect('edit', 'get', [$this->authUser->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->authUser->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->authUser->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([CollectorController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.collector.list'))
            ->assertViewIs('admin.user.collector.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([CollectorController::class, 'create']))
            ->assertOk()
            ->assertSee(__('user.collector.add'))
            ->assertViewIs('admin.user.collector.create');
    }

    public function test_edit_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([CollectorController::class, 'edit'], [$this->testingCollector->slug]))
            ->assertOk()
            ->assertSee($this->testingCollector->name)
            ->assertViewIs('admin.user.collector.edit');
    }

    public function test_store_success(): void
    {
        Queue::fake();
//        Storage::fake('images');

        $this->actingAs($this->authUser)
            ->post(action([CollectorController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectors.index')
            ->assertSessionHas('helper_flash_message', __('user.collector.created'));

        $collector = Collector::where('name', $this->request['name'])->first();
        $this->assertTrue($collector->hasAllRoles($this->request['roles']));
        $this->assertNotNull($collector->email_verified_at);

        $this->assertDatabaseHas('collectors', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function test_show_success(): void
    {
        $this->actingAs($this->authUser)
            ->get(action([CollectorController::class, 'show'], [$this->testingCollector->slug]))
            ->assertOk()
            ->assertSee($this->testingCollector->name)
            ->assertViewIs('admin.user.collector.show');
    }

    public function test_update_success(): void
    {
//        Storage::fake('images');

        Permission::create(['name' => 'test', 'display_name' => 'Test', 'guard_name' => 'collector']);
        Role::create(['name' => 'superadmin', 'display_name' => 'Super Admin', 'guard_name' => 'collector']);
        $role = Role::where('name', config('settings.default_collector_role'))->first();
        $role->givePermissionTo('entity.*');

        $this->request['name'] = 'newName';
        $this->request['first_name'] = 'New First Name';
        $this->request['roles'] = ['collector', 'superadmin'];
        $this->request['permissions'] = ['test'];

        $this->actingAs($this->authUser)
            ->put(
                action(
                    [CollectorController::class, 'update'],
                    [$this->testingCollector->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.collectors.index')
            ->assertSessionHas('helper_flash_message', __('user.collector.updated'));

        $collector = Collector::where('name', 'newname')->first();
        $this->assertTrue($collector->hasAllPermissions(['entity.edit', 'entity.delete', 'test']));
        $this->assertTrue($collector->hasAllRoles([config('settings.default_collector_role'), 'superadmin']));
        $this->assertFalse($collector->hasRole('editor'));

        $this->assertDatabaseHas('collectors', [
            'name' => 'newname',
            'first_name' => 'New First Name'
        ]);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->authUser)
            ->delete(action([CollectorController::class, 'destroy'], [$this->testingCollector->slug]))
            ->assertRedirectToRoute('admin.collectors.index')
            ->assertSessionHas('helper_flash_message', __('user.collector.deleted'));

        $this->assertDatabaseMissing('collectors', [
            'name' => $this->testingCollector->name,
            'deleted_at' => null
        ]);
    }

    public function test_has_wildcard_permissions_via_role_success(): void
    {
//        Storage::fake('images');

        $role = Role::where('name', config('settings.default_collector_role'))->first();

        $role->givePermissionTo('entity.*');

        $this->actingAs($this->authUser)
            ->post(action([CollectorController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectors.index')
            ->assertSessionHas('helper_flash_message', __('user.collector.created'));

        $collector = Collector::where('name', $this->request['name'])->first();
        $this->assertTrue($collector->hasAllPermissions(['entity.create', 'entity.edit', 'entity.delete']));
    }

    public function test_create_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.users.create'));

        $this->request['name'] = '';
        $this->request['password'] = 'wrong';
        $this->request['language'] = 'test';
        $this->request['roles'] = ['role.not-exist'];
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->authUser)
            ->post(action([AdminController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'password', 'language', 'roles', 'featured_image'])
            ->assertRedirectToRoute('admin.users.create');

        $this->assertDatabaseMissing('users', [
            'name' => $this->request['name']
        ]);
    }

    public function test_update_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.collectors.edit', [$this->testingCollector->slug]));

        $this->request['name'] = '';
        $this->request['language'] = 'test';
        $this->request['roles'] = ['role.not-exist'];
        $this->request['permissions'] = ['permission.not-exist'];

        $this->actingAs($this->authUser)
            ->put(
                action(
                    [CollectorController::class, 'update'],
                    [$this->testingCollector->slug]
                ),
                $this->request
            )
            ->assertInvalid(['name', 'language', 'roles', 'permissions'])
            ->assertRedirectToRoute('admin.collectors.edit', [$this->testingCollector->slug]);

        $this->assertDatabaseMissing('collectors', [
            'name' => $this->request['name']
        ]);
    }
}
