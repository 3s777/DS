<?php

namespace Admin\Auth\DTOs;

use App\Admin\Http\Requests\Auth\CreatePermissionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillPermissionDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePermissionRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillPermissionDTO::fromRequest(new CreatePermissionRequest($this->request));

        $this->assertInstanceOf(FillPermissionDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillPermissionDTO::make(
            name: $this->request['name'],
            display_name: $this->request['display_name'],
            guard_name: $this->request['guard_name'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillPermissionDTO::class, $data);
    }
}
