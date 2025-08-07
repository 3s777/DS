<?php

namespace App\Auth\Admin\DTOs;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Auth\Public\RegisterAdminRequest;
use Domain\Auth\DTOs\NewAdminDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewAdminDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterAdminRequest::factory()->create();
    }

    public function test_instance_created_from_register_request_success(): void
    {
        $data = NewAdminDTO::fromRequest(new RegisterAdminRequest($this->request));

        $this->assertInstanceOf(NewAdminDTO::class, $data);
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = NewAdminDTO::fromRequest(new CreateAdminRequest($this->request));

        $this->assertInstanceOf(NewAdminDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = NewAdminDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
        );

        $this->assertInstanceOf(NewAdminDTO::class, $data);
    }
}
