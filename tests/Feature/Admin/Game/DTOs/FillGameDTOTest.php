<?php

namespace Admin\Game\DTOs;

use App\Admin\Http\Requests\Game\CreateGameRequest;
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

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillGameDTO::fromRequest(new CreateGameRequest($this->request));

        $this->assertInstanceOf(FillGameDTO::class, $data);
    }


    public function test_instance_created_success(): void
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
