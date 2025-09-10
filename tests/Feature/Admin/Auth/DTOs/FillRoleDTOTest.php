<?php

namespace Admin\Auth\DTOs;

use App\Http\Requests\Auth\Admin\CreateRoleRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillRoleDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateRoleRequest::factory()->create();
        $this->request['permissions_admin'] = ['entity.*', 'entity.create', 'entity.edit', 'entity.delete'];
        $this->request['permissions_collector'] = ['entity_collector.*', 'entity_collector.create', 'entity_collector.edit', 'entity_collector.delete'];
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillRoleDTO::fromRequest(new CreateRoleRequest($this->request));

        $this->assertInstanceOf(FillRoleDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillRoleDTO::make(
            name: $this->request['name'],
            display_name: $this->request['display_name'],
            guard_name: $this->request['guard_name'],
            description: $this->request['description'],
            permissions_admin: $this->request['permissions_admin'],
            permissions_collector: $this->request['permissions_collector'],
        );

        $this->assertInstanceOf(FillRoleDTO::class, $data);
    }
}
