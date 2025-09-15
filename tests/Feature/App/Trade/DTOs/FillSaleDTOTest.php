<?php

namespace App\Trade\DTOs;

use Domain\Trade\DTOs\FillSaleDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\RequestFactories\App\Trade\CreateSaleRequestFactory;
use Tests\TestCase;

class FillSaleDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateSaleRequestFactory::new()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillSaleDTO::fromRequest(new Request($this->request));

        $this->assertInstanceOf(FillSaleDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {
        $data = FillSaleDTO::make(
            collectible_id: $this->request['collectible_id'],
            price: $this->request['price'],
            price_old: $this->request['price_old'],
            quantity: $this->request['quantity'],
            reservation: $this->request['reservation'],
            bidding: $this->request['bidding'],
            shipping: $this->request['shipping'],
            country_id: $this->request['country_id'],
            self_delivery: $this->request['self_delivery'],
            shipping_countries: $this->request['shipping_countries'] ?? null,
        );

        $this->assertInstanceOf(FillSaleDTO::class, $data);
    }
}
