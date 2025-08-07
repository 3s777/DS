<?php

namespace App\Trade\Services;

use Domain\Settings\Models\Country;
use Domain\Trade\DTOs\FillAuctionDTO;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;
use Domain\Trade\Services\AuctionService;
use Domain\Trade\ValueObjects\AuctionValueObject;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Support\ValueObjects\PriceValueObject;
use Tests\RequestFactories\Trade\CreateAuctionRequestFactory;
use Tests\TestCase;

class AuctionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateAuctionRequestFactory::new()->create();
    }

    public function test_sale_success(): void
    {
        $this->assertDatabaseMissing('auctions', [
            'collectible_id' => $this->request['collectible_id']
        ]);

        $auctionService = app(AuctionService::class);

        $auctionService->create(FillAuctionDTO::fromRequest(
            new Request($this->request)
        ));

        $this->assertDatabaseHas('auctions', [
            'collectible_id' => $this->request['collectible_id']
        ]);

        $auction = Auction::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertInstanceOf(AuctionValueObject::class, $auction->collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $auction->collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $auction->collectible->auction_data->step());
        $this->assertInstanceOf(PriceValueObject::class, $auction->collectible->auction_data->blitz());
        $this->assertSame($auction->collectible->auction_data->price()->value(), $this->request['price']);
        $this->assertSame($auction->collectible->auction_data->step()->value(), $this->request['step']);
        $this->assertSame($auction->collectible->auction_data->self_delivery(), $this->request['self_delivery']);
        $this->assertSame($auction->price->value(), $this->request['price']);
        $this->assertSame($auction->finished_at->format('Y-m-d H:m'), $this->request['finished_at']);
        $this->assertSame($auction->self_delivery, $this->request['self_delivery']);
    }

    public function test_sale_updated_success(): void
    {
        $auctionService = app(AuctionService::class);

        $auctionService->create(FillAuctionDTO::fromRequest(
            new Request($this->request)
        ));

        $auction = Auction::where('collectible_id', $this->request['collectible_id'])->first();
        $country = Country::factory()->create();

        $this->request['collectible_id'] = '10000000';
        $this->request['price'] = 200;
        $this->request['step'] = 30;
        $this->request['finished_at'] = '2026-10-03 10:15';
        $this->request['blitz'] = 100;
        $this->request['renewal'] = 3;
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $country->id;
        $this->request['self_delivery'] = true;

        $auctionService->update($auction, FillAuctionDTO::fromRequest(new Request($this->request)));

        $this->assertDatabaseMissing('auctions', [
            'collectible_id' => '10000000',
        ]);

        $updatedAuction = Auction::find($auction->id);

        $this->assertSame($updatedAuction->price->value(), $this->request['price']);
        $this->assertSame($auction->collectible_id, $updatedAuction->collectible_id);
        $this->assertInstanceOf(AuctionValueObject::class, $updatedAuction->collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $updatedAuction->collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $updatedAuction->collectible->auction_data->step());
        $this->assertInstanceOf(PriceValueObject::class, $updatedAuction->collectible->auction_data->blitz());
        $this->assertSame($updatedAuction->collectible->auction_data->price()->value(), $this->request['price']);
        $this->assertSame($updatedAuction->collectible->auction_data->blitz()->value(), $this->request['blitz']);
        $this->assertSame($updatedAuction->collectible->auction_data->renewal(), $this->request['renewal']);
        $this->assertTrue($updatedAuction->self_delivery);
        $this->assertSame($updatedAuction->price->value(), $this->request['price']);
        $this->assertSame($updatedAuction->finished_at->format('Y-m-d H:i'), '2026-10-03 10:15');
    }

    public function test_auction_created_and_updated_with_country_success(): void
    {
        $countries = Country::factory(3)->create();
        $auctionService = app(AuctionService::class);

        $this->request['shipping'] = ShippingEnum::Selected->value;
        $this->request['shipping_countries'] = $countries->pluck('id')->toArray();

        $auctionService->create(FillAuctionDTO::fromRequest(
            new Request($this->request)
        ));

        $auction = Auction::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertEquals($countries->pluck('id'), $auction->shippingCountries->pluck('id'));

        $newCountries = Country::factory(3)->create();
        $this->request['shipping'] = ShippingEnum::Selected->value;
        $this->request['shipping_countries'] = $newCountries->pluck('id')->toArray();

        $auctionService->update($auction, FillAuctionDTO::fromRequest(new Request($this->request)));

        $updatedAuction = Auction::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertEquals($newCountries->pluck('id'), $updatedAuction->shippingCountries->pluck('id'));
        $this->assertInstanceOf(MorphToMany::class, $updatedAuction->shippingCountries());
    }
}
