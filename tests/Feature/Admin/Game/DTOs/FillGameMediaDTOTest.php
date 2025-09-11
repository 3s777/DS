<?php

namespace Admin\Game\DTOs;

use App\Admin\Http\Requests\Game\CreateGameMediaRequest;
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

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillGameMediaDTO::fromRequest(new CreateGameMediaRequest($this->request));

        $this->assertInstanceOf(FillGameMediaDTO::class, $data);
    }


    public function test_instance_created_success(): void
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
