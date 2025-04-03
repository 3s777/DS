<?php

namespace App\Auth\Admin\Services;

use App\Http\Requests\Auth\Role\CreateRoleRequest;
use Database\Seeders\PermissionsTestSeeder;
use Domain\Auth\DTOs\FillRoleDTO;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Auth\Services\RoleService;
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

    /**
     * @test
     * @return void
     */
    public function it_role_created_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_role_updated_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_role_with_permission_updated_success(): void
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
