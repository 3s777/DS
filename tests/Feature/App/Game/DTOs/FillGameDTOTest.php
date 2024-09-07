<?php

namespace App\Game\DTOs;

use App\Http\Requests\Game\CreateGameRequest;
use Domain\Game\DTOs\FillGameDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillGameDTOTest extends TestCase
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
        $data = FillGameDTO::fromRequest(new CreateGameRequest($this->request));

        $this->assertInstanceOf(FillGameDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillGameDTO::fromRequest(new CreateGameRequest($this->request));

        $this->assertInstanceOf(FillGameDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillGameDTO::make(
            name: $this->request['name'],
            description: $this->request['description'],
            released_at: $this->request['released_at'],
            developers: $this->request['developers'],
            publishers: $this->request['publishers'],
            genres: $this->request['genres'],
            platforms: $this->request['platforms'],
        );

        $this->assertInstanceOf(FillGameDTO::class, $data);
    }
}
