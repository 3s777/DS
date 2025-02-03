<?php

namespace App\Auth\DTOs;

use App\Http\Requests\Auth\LoginRequest;
use Domain\Auth\DTOs\LoginAdminDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = LoginRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_login_request_success(): void
    {
        $data = LoginAdminDTO::fromRequest(new LoginRequest($this->request));

        $this->assertInstanceOf(LoginAdminDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = LoginAdminDTO::make(
            $this->request['email'],
            $this->request['password'],
            $this->request['remember']
        );

        $this->assertInstanceOf(LoginAdminDTO::class, $data);
    }
}
