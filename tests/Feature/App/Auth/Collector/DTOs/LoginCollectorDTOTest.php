<?php

namespace App\Auth\Admin\DTOs;

use App\Http\Requests\Auth\Collector\LoginRequest;
use Domain\Auth\DTOs\LoginCollectorDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginCollectorDTOTest extends TestCase
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
        $data = LoginCollectorDTO::fromRequest(new LoginRequest($this->request));

        $this->assertInstanceOf(LoginCollectorDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = LoginCollectorDTO::make(
            $this->request['email'],
            $this->request['password'],
            $this->request['remember']
        );

        $this->assertInstanceOf(LoginCollectorDTO::class, $data);
    }
}
