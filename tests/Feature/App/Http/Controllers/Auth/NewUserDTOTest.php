<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\DTOs\NewUserDTO;
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
    public function it_instance_created_from_form_request_success(): void
    {
        $data = NewUserDTO::fromRequest(new RegisterRequest($this->request));

        $this->assertInstanceOf(NewUserDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = NewUserDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password']
        );

        $this->assertInstanceOf(NewUserDTO::class, $data);
    }
}
