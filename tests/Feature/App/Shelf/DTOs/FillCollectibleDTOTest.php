<?php

namespace App\Shelf\DTOs;

use App\Http\Requests\Shelf\CreateCollectibleGameRequest;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillCollectibleDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillCollectibleDTO::fromRequest(new CreateCollectibleGameRequest($this->request));

        $this->assertInstanceOf(FillCollectibleDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillCollectibleDTO::make(
            name: $this->request['name'],
            shelf_id: $this->request['shelf_id'],
            article_number: $this->request['article_number'],
            condition: $this->request['condition'],
            seller: $this->request['seller'],
            purchase_price: $this->request['purchase_price'],
            purchased_at: $this->request['purchased_at'],
            additional_field: $this->request['additional_field'],
            properties: [
                'is_done' => $this->request['properties']['is_done'],
                'is_digital' => $this->request['properties']['is_digital']
            ],
            target: $this->request['target'],
            collectable: $this->request['collectable'],
            collectable_type: $this->request['collectable_type'],
            kit_conditions: $this->request['kit_conditions'],
            sale: $this->request['sale'],
            auction: $this->request['auction'],
            description: $this->request['description'],
        );

        $this->assertInstanceOf(FillCollectibleDTO::class, $data);
    }
}
