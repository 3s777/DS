<?php

namespace App\Trade\ValueObjects;

use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\ValueObjects\AuctionValueObject;
use Domain\Trade\ValueObjects\SaleValueObject;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;
use TypeError;

class AuctionValueObjectTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function it_all(): void
    {
        $auction = AuctionValueObject::make(
            100,
            20,
            '2024-10-03 10:25',
            5,
            ShippingEnum::None->value
        );

        $this->assertInstanceOf(AuctionValueObject::class, $auction);
        $this->assertSame(100, $auction->price()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $auction->price());
        $this->assertSame(20, $auction->step()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $auction->step());
        $this->assertSame('2024-10-03 10:25', $auction->finished_at());
    }

    /**
     * @test
     * @return void
     */
    public function it_price_type_fail(): void
    {
        $this->expectException(TypeError::class);
        SaleValueObject::make(
            'wrong string',
            20,
            '2024-10-03 10:25',
            5,
            ShippingEnum::None->value
        );
    }
}
