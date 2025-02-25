<?php

namespace App\Trade\ValueObjects;

use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\ValueObjects\SaleValueObject;
use InvalidArgumentException;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;
use TypeError;

class SaleValueObjectTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_all(): void
    {
        $sale = SaleValueObject::make(
            100,
            2,
            5,
            ShippingEnum::None->value,
            500,
            false,
            true,
            ReservationEnum::None->value,
        );

        $this->assertInstanceOf(SaleValueObject::class, $sale);
        $this->assertEquals(100, $sale->price()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $sale->price());
        $this->assertEquals(500, $sale->priceOld()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $sale->priceOld());
        $this->assertEquals([
            'price' => PriceValueObject::make(100),
            'price_old' => PriceValueObject::make(500),
            'quantity' => 2,
            'bidding' => false,
            'country_id' => 5,
            'shipping' => ShippingEnum::None->value,
            'self_delivery' => true,
            'reservation' => ReservationEnum::None->value
        ], $sale->raw());
    }

    /**
     * @test
     * @return void
     */
    public function it_price_type_fail(): void
    {
        $this->expectException(TypeError::class);
        SaleValueObject::make(
            'wrong_string',
            2,
            5,
            ShippingEnum::None->value
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_quantity_type_fail(): void
    {
        $this->expectException(TypeError::class);
        SaleValueObject::make(
            10000,
            2,
            'wrong_string',
            ShippingEnum::None->value
        );
    }
}
