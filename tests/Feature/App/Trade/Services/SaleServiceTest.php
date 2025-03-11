<?php

namespace App\Trade\Services;

use Domain\Settings\Models\Country;
use Domain\Trade\DTOs\FillSaleDTO;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Sale;
use Domain\Trade\Services\SaleService;
use Domain\Trade\ValueObjects\SaleValueObject;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Support\ValueObjects\PriceValueObject;
use Tests\RequestFactories\Trade\CreateSaleRequestFactory;
use Tests\TestCase;

class SaleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateSaleRequestFactory::new()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_sale_success(): void
    {
        $this->assertDatabaseMissing('sales', [
            'collectible_id' => $this->request['collectible_id']
        ]);

        $saleService = app(SaleService::class);

        $saleService->create(FillSaleDTO::fromRequest(
            new Request($this->request)
        ));

        $this->assertDatabaseHas('sales', [
            'collectible_id' => $this->request['collectible_id']
        ]);

        $sale = Sale::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertInstanceOf(SaleValueObject::class, $sale->collectible->sale_data);
        $this->assertInstanceOf(PriceValueObject::class, $sale->collectible->sale_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $sale->collectible->sale_data->priceOld());
        $this->assertSame($sale->collectible->sale_data->price()->value(), $this->request['price']);
        $this->assertSame($sale->collectible->sale_data->quantity(), $this->request['quantity']);
        $this->assertSame($sale->collectible->sale_data->self_delivery(), $this->request['self_delivery']);
        $this->assertSame($sale->price->value(), $this->request['price']);
        $this->assertSame($sale->quantity, $this->request['quantity']);
        $this->assertSame($sale->self_delivery, $this->request['self_delivery']);
    }

    /**
     * @test
     * @return void
     */
    public function it_sale_updated_success(): void
    {
        $saleService = app(SaleService::class);

        $saleService->create(FillSaleDTO::fromRequest(
            new Request($this->request)
        ));

        $sale = Sale::where('collectible_id', $this->request['collectible_id'])->first();
        $country = Country::factory()->create();

        $this->request['collectible_id'] = '10000000';
        $this->request['price'] = 200;
        $this->request['price_old'] = 300;
        $this->request['quantity'] = 5;
        $this->request['bidding'] = true;
        $this->request['reservation'] = ReservationEnum::None->value;
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $country->id;
        $this->request['self_delivery'] = true;

        $saleService->update($sale, FillSaleDTO::fromRequest(new Request($this->request)));

        $this->assertDatabaseMissing('sales', [
            'collectible_id' => '10000000',
        ]);

        $updatedSale = Sale::find($sale->id);

        $this->assertSame($updatedSale->price->value(), $this->request['price']);
        $this->assertSame($sale->collectible_id, $updatedSale->collectible_id);
        $this->assertInstanceOf(SaleValueObject::class, $updatedSale->collectible->sale_data);
        $this->assertInstanceOf(PriceValueObject::class, $updatedSale->collectible->sale_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $updatedSale->collectible->sale_data->priceOld());
        $this->assertSame($updatedSale->collectible->sale_data->price()->value(), $this->request['price']);
        $this->assertSame($updatedSale->collectible->sale_data->quantity(), $this->request['quantity']);
        $this->assertTrue($updatedSale->self_delivery);
        $this->assertTrue($updatedSale->bidding);
        $this->assertSame($updatedSale->price->value(), $this->request['price']);
        $this->assertSame($updatedSale->quantity, $this->request['quantity']);
        $this->assertSame($updatedSale->self_delivery, $this->request['self_delivery']);
    }

    /**
     * @test
     * @return void
     */
    public function it_sale_created_and_updated_with_country_success(): void
    {
        $countries = Country::factory(3)->create();
        $saleService = app(SaleService::class);

        $this->request['shipping'] = ShippingEnum::Selected->value;
        $this->request['shipping_countries'] = $countries->pluck('id')->toArray();

        $saleService->create(FillSaleDTO::fromRequest(
            new Request($this->request)
        ));

        $sale = Sale::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertEquals($countries->pluck('id'), $sale->shippingCountries->pluck('id'));

        $newCountries = Country::factory(3)->create();
        $this->request['shipping'] = ShippingEnum::Selected->value;
        $this->request['shipping_countries'] = $newCountries->pluck('id')->toArray();

        $saleService->update($sale, FillSaleDTO::fromRequest(new Request($this->request)));

        $updatedSale = Sale::where('collectible_id', $this->request['collectible_id'])->first();

        $this->assertEquals($newCountries->pluck('id'), $updatedSale->shippingCountries->pluck('id'));
        $this->assertInstanceOf(MorphToMany::class, $updatedSale->shippingCountries());
    }
}
