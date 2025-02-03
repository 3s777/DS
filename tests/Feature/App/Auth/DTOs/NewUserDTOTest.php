<?php

namespace App\Auth\DTOs;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\User\CreateUserRequest;
use Domain\Auth\DTOs\NewAdminDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_register_request_success(): void
    {
        $data = NewAdminDTO::fromRequest(new RegisterRequest($this->request));

        $this->assertInstanceOf(NewAdminDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = NewAdminDTO::fromRequest(new CreateUserRequest($this->request));

        $this->assertInstanceOf(NewAdminDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
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
