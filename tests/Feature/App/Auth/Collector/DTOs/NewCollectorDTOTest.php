<?php

namespace App\Auth\Admin\DTOs;

use App\Http\Requests\Auth\Collector\CreateCollectorRequest;
use App\Http\Requests\Auth\Collector\RegisterRequest;
use Domain\Auth\DTOs\NewCollectorDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewCollectorDTOTest extends TestCase
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
        $data = NewCollectorDTO::fromRequest(new RegisterRequest($this->request));

        $this->assertInstanceOf(NewCollectorDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = NewCollectorDTO::fromRequest(new CreateCollectorRequest($this->request));

        $this->assertInstanceOf(NewCollectorDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = NewCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['password'],
            $this->request['language']
        );

        $this->assertInstanceOf(NewCollectorDTO::class, $data);
    }
}
