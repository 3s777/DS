<?php

namespace Admin\Auth\Controllers;

use App\Http\Controllers\Auth\Admin\RoleController;
use App\Http\Requests\Auth\Admin\CreateRoleRequest;
use Database\Factories\Auth\RoleFactory;
use Database\Factories\Auth\UserFactory;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Role $role;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->user = UserFactory::new()->create();

        $this->role = RoleFactory::new()->create();

        $this->request = CreateRoleRequest::factory()->create(['guard_name' => 'admin']);

        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([RoleController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->role->id]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->role->id], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->role->id]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.role.list'))
            ->assertViewIs('admin.user.role.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'create']))
            ->assertOk()
            ->assertSee(__('user.role.add'))
            ->assertViewIs('admin.user.role.create');
    }

    public function test_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'edit'], [$this->role->id]))
            ->assertOk()
            ->assertSee($this->role->name)
            ->assertViewIs('admin.user.role.edit');
    }

    public function test_store_success(): void
    {
        $this->request['permissions_admin'] = ['entity.*', 'entity.create', 'entity.edit', 'entity.delete'];

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.created'));

        $role = Role::where('name', $this->request['name'])->first();
        $this->assertTrue($role->hasAllPermissions(['entity.*', 'entity.create', 'entity.edit', 'entity.delete']));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_store_guard_collector_success(): void
    {
        $this->request['guard_name'] = 'collector';
        $this->request['permissions_admin'] = ['entity.*', 'entity.create', 'entity.edit', 'entity.delete'];
        $this->request['permissions_collector'] = ['entity_collector.*', 'entity_collector.create', 'entity_collector.edit', 'entity_collector.delete'];

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.created'));

        $role = Role::where('name', $this->request['name'])->first();
        $this->assertFalse($role->hasAllPermissions(['entity.*', 'entity.create', 'entity.edit', 'entity.delete']));
        $this->assertTrue($role->hasAllPermissions(['entity_collector.*', 'entity_collector.create', 'entity_collector.edit', 'entity_collector.delete']));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_has_wildcard_permissions_success(): void
    {
        $this->request['permissions_admin'] = ['entity.*'];

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.created'));

        $role = Role::where('name', $this->request['name'])->first();
        $this->assertTrue($role->hasAllPermissions(['entity.create', 'entity.edit', 'entity.delete']));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_validation_name_and_guard_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.roles.create'));

        $this->request['name'] = '';
        $this->request['display_name'] = '';
        $this->request['guard_name'] = 'false_name';

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'display_name', 'guard_name'])
            ->assertRedirectToRoute('admin.roles.create');

        $this->assertDatabaseMissing('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_validation_permission_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.roles.create'));

        $this->request['permissions_admin'] = ['permission.not-exist'];

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertInvalid(['permissions_admin'])
            ->assertRedirectToRoute('admin.roles.create');

        $this->assertDatabaseMissing('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';
        $this->request['permissions_admin'] = ['entity.edit', 'entity.delete'];
        $this->request['permissions_collector'] = ['entity_collector.edit', 'entity_collector.delete'];

        $this->actingAs($this->user)
            ->put(
                action(
                    [RoleController::class, 'update'],
                    [$this->role->id]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.updated'));

        $role = Role::where('name', $this->request['name'])->first();
        $this->assertFalse($role->hasAllPermissions(['entity_collector.edit', 'entity_collector.delete']));
        $this->assertTrue($role->hasAllPermissions(['entity.edit', 'entity.delete']));
        $this->assertFalse($role->hasAllPermissions(['entity.*', 'entity.create']));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }


    public function test_update_with_locale_success(): void
    {
        $this->request['name'] = 'newName';
        $this->request['display_name'] = 'ТестРус';

        $response = $this->actingAs($this->user)
            ->put(
                action(
                    [RoleController::class, 'update'],
                    [$this->role->id]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.updated'));

        $this->followRedirects($response)->assertSee('ТестРус');

        URL::defaults(['locale' => 'en']);

        $this->request['display_name'] = 'TestEng';

        $response = $this->actingAs($this->user)
            ->put(
                action(
                    [RoleController::class, 'update'],
                    [$this->role->id]
                ),
                $this->request
            );

        $this->followRedirects($response)->assertSee('TestEng');

        $this->assertDatabaseHas('roles', [
            'display_name' => '{"en": "TestEng","ru": "ТестРус"}'
        ]);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([RoleController::class, 'destroy'], [$this->role->id]))
            ->assertRedirectToRoute('admin.roles.index')
            ->assertSessionHas('helper_flash_message', __('user.role.deleted'));

        $this->assertDatabaseMissing('roles', [
            'name' => $this->role->name,
            'deleted_at' => null
        ]);
    }
}
