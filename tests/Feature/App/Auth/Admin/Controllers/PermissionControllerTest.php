<?php

namespace App\Auth\Admin\Controllers;

use App\Http\Controllers\Auth\Admin\PermissionController;
use App\Http\Requests\Auth\Permission\CreatePermissionRequest;
use App\Http\Requests\Auth\Permission\UpdatePermissionRequest;
use Database\Factories\Auth\PermissionFactory;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Permission $permission;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();

        $this->permission = PermissionFactory::new()->create();

        $this->request = CreatePermissionRequest::factory()->create();

        $this->updateRequest = UpdatePermissionRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([PermissionController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->permission->id]);
        $this->checkNotAuthRedirect('store', 'post', [$this->permission->id], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->permission->id], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->permission->id]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PermissionController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.permission.list'))
            ->assertViewIs('admin.user.permission.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PermissionController::class, 'create']))
            ->assertOk()
            ->assertSee(__('user.permission.add'))
            ->assertViewIs('admin.user.permission.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PermissionController::class, 'edit'], [$this->permission->id]))
            ->assertOk()
            ->assertSee($this->permission->name)
            ->assertViewIs('admin.user.permission.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([PermissionController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.permissions.index')
            ->assertSessionHas('helper_flash_message', __('user.permission.created'));

        $this->assertDatabaseHas('permissions', [
            'name' => $this->request['name']
        ]);
    }


    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.permissions.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([PermissionController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.permissions.create');

        $this->assertDatabaseMissing('permissions', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $this->updateRequest['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [PermissionController::class, 'update'],
                    [$this->permission->id]
                ),
                $this->updateRequest
            )
            ->assertRedirectToRoute('admin.permissions.index')
            ->assertSessionHas('helper_flash_message', __('user.permission.updated'));

        $this->assertDatabaseHas('permissions', [
            'name' => $this->updateRequest['name']
        ]);
    }


    /**
     * @test
     * @return void
     */
    public function it_update_with_locale_success(): void
    {
        $this->updateRequest['name'] = 'newName';
        $this->updateRequest['display_name'] = 'ТестРус';

        $response = $this->actingAs($this->user)
            ->put(
                action(
                    [PermissionController::class, 'update'],
                    [$this->permission->id]
                ),
                $this->updateRequest
            )
            ->assertRedirectToRoute('admin.permissions.index')
            ->assertSessionHas('helper_flash_message', __('user.permission.updated'));

        $this->followRedirects($response)->assertSee('ТестРус');

        URL::defaults(['locale' => 'en']);

        $this->updateRequest['display_name'] = 'TestEng';

        $response = $this->actingAs($this->user)
            ->put(
                action(
                    [PermissionController::class, 'update'],
                    [$this->permission->id]
                ),
                $this->updateRequest
            );

        $this->followRedirects($response)->assertSee('TestEng');

        $this->assertDatabaseHas('permissions', [
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
            ->delete(action([PermissionController::class, 'destroy'], [$this->permission->id]))
            ->assertRedirectToRoute('admin.permissions.index')
            ->assertSessionHas('helper_flash_message', __('user.permission.deleted'));

        $this->assertDatabaseMissing('permissions', [
            'name' => $this->permission->name,
            'deleted_at' => null
        ]);
    }
}
