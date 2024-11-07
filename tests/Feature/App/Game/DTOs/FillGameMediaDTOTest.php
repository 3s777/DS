<?php

namespace App\Game\DTOs;

use App\Http\Requests\Game\CreateGameMediaRequest;
use Domain\Game\DTOs\FillGameMediaDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillGameMediaDTOTest extends TestCase
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
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillGameMediaDTO::fromRequest(new CreateGameMediaRequest($this->request));

        $this->assertInstanceOf(FillGameMediaDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillGameMediaDTO::make(
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

        $this->assertInstanceOf(FillGameMediaDTO::class, $data);
    }
}
