<?php

namespace App\Trade\DTOs;

use Domain\Trade\DTOs\FillAuctionDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\RequestFactories\Trade\CreateAuctionRequestFactory;
use Tests\TestCase;

class FillAuctionDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateAuctionRequestFactory::new()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillAuctionDTO::fromRequest(new Request($this->request));

        $this->assertInstanceOf(FillAuctionDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {
        $data = FillAuctionDTO::make(
            collectible_id: $this->request['collectible_id'],
            price: $this->request['price'],
            step: $this->request['step'],
            finished_at: $this->request['finished_at'],
            blitz: $this->request['blitz'],
            renewal: $this->request['renewal'],
            shipping: $this->request['shipping'],
            country_id: $this->request['country_id'],
            self_delivery: $this->request['self_delivery'],
            shipping_countries: $this->request['shipping_countries'] ?? null,
        );

        $this->assertInstanceOf(FillAuctionDTO::class, $data);
    }
}
