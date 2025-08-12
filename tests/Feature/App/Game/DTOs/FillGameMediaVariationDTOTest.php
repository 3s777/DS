<?php

namespace App\Game\DTOs;

use App\Http\Requests\Game\Admin\CreateGameMediaRequest;
use App\Http\Requests\Game\Admin\CreateGameMediaVariationRequest;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillGameMediaVariationDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameMediaVariationRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillGameMediaVariationDTO::fromRequest(new CreateGameMediaRequest($this->request));

        $this->assertInstanceOf(FillGameMediaVariationDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillGameMediaVariationDTO::make(
            name: $this->request['name'],
            game_media_id: $this->request['game_media_id'],
            description: $this->request['description'],
            article_number: $this->request['article_number'],
            alternative_names: $this->request['alternative_names'],
            barcodes: $this->request['barcodes'],
            is_main: $this->request['is_main'],
        );

        $this->assertInstanceOf(FillGameMediaVariationDTO::class, $data);
    }
}
