<?php

namespace Admin\Auth\DTOs;

use App\Admin\Http\Requests\Auth\CreateAdminRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateAdminDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateAdminRequest::factory()->create();
    }

    public function test_instance_created_from_form_request_success(): void
    {
        $data = UpdateAdminDTO::fromRequest(new CreateAdminRequest($this->request));

        $this->assertInstanceOf(UpdateAdminDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {

        $data = UpdateAdminDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['permissions'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['featured_image'],
            $this->request['featured_image_uploaded'],
            $this->request['is_verified'],
        );

        $this->assertInstanceOf(UpdateAdminDTO::class, $data);
    }
}
