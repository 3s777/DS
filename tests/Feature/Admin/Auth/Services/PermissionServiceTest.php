<?php

namespace Admin\Auth\Services;

use Admin\Auth\DTOs\FillPermissionDTO;
use App\Admin\Http\Requests\Auth\CreatePermissionRequest;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class PermissionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePermissionRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    public function test_permission_created_success(): void
    {
        $this->assertDatabaseMissing('permissions', [
            'name' => $this->request['name']
        ]);

        $request = new Request($this->request);

        $permissionService = app(PermissionService::class);

        $permissionService->create(FillPermissionDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('permissions', [
            'name' => $this->request['name']
        ]);
    }

    public function test_permission_updated_success(): void
    {
        $createRequest = new Request($this->request);

        $permissionService = app(PermissionService::class);

        $permissionService->create(FillPermissionDTO::fromRequest(
            $createRequest
        ));

        $permission = Permission::where('name', $this->request['name'])->first();

        $this->request['name'] = 'NewNamePermission';
        $this->request['guard_name'] = 'collector';

        $updateRequest = new Request($this->request);

        $permissionService->update($permission, FillPermissionDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('permissions', [
            'name' => 'NewNamePermission',
        ]);

        $updatedPermission = Permission::where('name', 'NewNamePermission')->first();

        $this->assertSame($updatedPermission->name, $this->request['name']);
        $this->assertSame($updatedPermission->guard_name, $this->request['guard_name']);
    }
}
