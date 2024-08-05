<?php

namespace App\Game\DTOs;

use App\Http\Requests\Game\CreateGameRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Game\DTOs\CreateGameDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateGameDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_register_request_success(): void
    {
        $data = CreateGameDTO::fromRequest(new CreateGameRequest($this->request));

        $this->assertInstanceOf(CreateGameDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = CreateGameDTO::fromRequest(new CreateGameRequest($this->request));

        $this->assertInstanceOf(CreateGameDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = CreateGameDTO::make(
            name: $this->request['name'],
            description: $this->request['description'],
            released_at: $this->request['released_at'],
            developers: $this->request['developers'],
            publishers: $this->request['publishers'],
            genres: $this->request['genres'],
            platforms: $this->request['platforms'],
        );

        $this->assertInstanceOf(CreateGameDTO::class, $data);
    }
}
