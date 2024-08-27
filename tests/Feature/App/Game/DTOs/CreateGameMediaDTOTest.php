<?php

namespace App\Game\DTOs;

use App\Http\Requests\Game\CreateGameMediaRequest;
use App\Http\Requests\Game\CreateGameRequest;
use Domain\Game\DTOs\CreateGameDTO;
use Domain\Game\DTOs\CreateGameMediaDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateGameMediaDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameMediaRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_register_request_success(): void
    {
        $data = CreateGameMediaDTO::fromRequest(new CreateGameMediaRequest($this->request));

        $this->assertInstanceOf(CreateGameMediaDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = CreateGameMediaDTO::fromRequest(new CreateGameMediaRequest($this->request));

        $this->assertInstanceOf(CreateGameMediaDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = CreateGameMediaDTO::make(
            name: $this->request['name'],
            description: $this->request['description'],
            released_at: $this->request['released_at'],
            developers: $this->request['developers'],
            publishers: $this->request['publishers'],
            genres: $this->request['genres'],
            platforms: $this->request['platforms'],
            games: $this->request['games'],
            alternative_names: $this->request['alternative_names'],
            barcodes: $this->request['barcodes'],
        );

        $this->assertInstanceOf(CreateGameMediaDTO::class, $data);
    }
}
