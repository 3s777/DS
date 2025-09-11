<?php

namespace Admin\Auth\Services;

use Admin\Auth\DTOs\FillRoleDTO;
use App\Admin\Http\Requests\Auth\CreateRoleRequest;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateRoleRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    public function test_role_created_success(): void
    {
        $this->assertDatabaseMissing('roles', [
            'name' => $this->request['name']
        ]);

        $request = new Request($this->request);

        $roleService = app(RoleService::class);

        $roleService->create(FillRoleDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('roles', [
            'name' => $this->request['name']
        ]);
    }

    public function test_role_updated_success(): void
    {
        $createRequest = new Request($this->request);

        $roleService = app(RoleService::class);

        $roleService->create(FillRoleDTO::fromRequest(
            $createRequest
        ));

        $role = Role::where('name', $this->request['name'])->first();

        $this->request['name'] = 'NewNameRole';
        $this->request['guard_name'] = 'collector';

        $updateRequest = new Request($this->request);

        $roleService->update($role, FillRoleDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('roles', [
            'name' => 'NewNameRole',
        ]);

        $updatedRole = Role::where('name', 'NewNameRole')->first();

        $this->assertSame($updatedRole->name, $this->request['name']);
        $this->assertSame($updatedRole->guard_name, $this->request['guard_name']);
    }

    public function test_role_with_permission_updated_success(): void
    {
        $this->artisan('db:seed', ['--class' => PermissionsTestSeeder::class]);

        $createRequest = new Request($this->request);

        $roleService = app(RoleService::class);

        $roleService->create(FillRoleDTO::fromRequest(
            $createRequest
        ));

        $role = Role::where('name', $this->request['name'])->first();

        $this->request['name'] = 'NewNameRole';
        $this->request['guard_name'] = 'collector';
        $this->request['permissions_admin'] = ['entity.edit', 'entity.delete'];
        $this->request['permissions_collector'] = ['entity_collector.edit', 'entity_collector.delete'];

        $updateRequest = new Request($this->request);

        $roleService->update($role, FillRoleDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('roles', [
            'name' => 'NewNameRole',
        ]);

        $updatedRole = Role::where('name', 'NewNameRole')->first();

        $this->assertTrue($updatedRole->hasAllPermissions(['entity_collector.edit', 'entity_collector.delete']));
        $this->assertFalse($updatedRole->hasAllPermissions(['entity.edit', 'entity.delete']));

        $this->assertSame($updatedRole->name, $this->request['name']);
        $this->assertSame($updatedRole->guard_name, $this->request['guard_name']);
    }
}
