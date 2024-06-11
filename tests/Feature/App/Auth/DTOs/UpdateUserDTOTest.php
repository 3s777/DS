<?php

namespace App\Auth\DTOs;

use App\Http\Requests\Auth\User\CreateUserRequest;
use Domain\Auth\DTOs\UpdateUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateUserRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_form_request_success(): void
    {
        $data = UpdateUserDTO::fromRequest(new CreateUserRequest($this->request));

        $this->assertInstanceOf(UpdateUserDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {

        $data = UpdateUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['language_id'],
            $this->request['roles'],
            $this->request['permissions'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['thumbnail'],
            $this->request['thumbnail_uploaded'],
            $this->request['is_verified'],
        );

        $this->assertInstanceOf(UpdateUserDTO::class, $data);
    }
}
