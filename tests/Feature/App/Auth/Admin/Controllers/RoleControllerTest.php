<?php

namespace App\Auth\Admin\Controllers;

use App\Http\Controllers\Auth\RoleController;
use App\Http\Requests\Auth\Role\CreateRoleRequest;
use Database\Factories\RoleFactory;
use Database\Factories\UserFactory;
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

        $this->request = CreateRoleRequest::factory()->create();

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

    /**
     * @test
     * @return void
     */
    public function it_pages_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->role->id]);
        $this->checkNotAuthRedirect('store', 'post', [$this->role->id], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->role->id], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->role->id]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.role.list'))
            ->assertViewIs('admin.user.role.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'create']))
            ->assertOk()
            ->assertSee(__('user.role.add'))
            ->assertViewIs('admin.user.role.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([RoleController::class, 'edit'], [$this->role->id]))
            ->assertOk()
            ->assertSee($this->role->name)
            ->assertViewIs('admin.user.role.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
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

    /**
     * @test
     * @return void
     */
    public function it_has_wildcard_permissions_success(): void
    {
        $this->request['permissions'] = ['entity.*'];

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

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.roles.create'));

        $this->request['name'] = '';
        $this->request['display_name'] = '';

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'display_name'])
            ->assertRedirectToRoute('admin.roles.create');

        $this->assertDatabaseMissing('roles', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_permission_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.roles.create'));

        $this->request['permissions'] = ['permission.not-exist'];

        $this->actingAs($this->user)
            ->post(action([RoleController::class, 'store']), $this->request)
            ->assertInvalid(['permissions'])
            ->assertRedirectToRoute('admin.roles.create');

        $this->assertDatabaseMissing('roles', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $this->request['name'] = 'newName';
        $this->request['permissions'] = ['entity.edit', 'entity.delete'];

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
        $this->assertTrue($role->hasAllPermissions(['entity.edit', 'entity.delete']));
        $this->assertFalse($role->hasAllPermissions(['entity.*', 'entity.create']));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }


    /**
     * @test
     * @return void
     */
    public function it_update_with_locale_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
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
