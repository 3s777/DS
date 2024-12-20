<?php

namespace Services\Support\ValueObjects;

use InvalidArgumentException;
use Support\ValueObjects\PriceValueObject;
use Support\ValueObjects\SaleValueObject;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function it_all(): void
    {
        $sale = SaleValueObject::make(100, 500);

        $this->assertInstanceOf(SaleValueObject::class, $sale);
        $this->assertEquals(100, $sale->price()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $sale->price());
        $this->assertEquals(500, $sale->priceOld()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $sale->priceOld());
        $this->assertEquals([
            'price' => PriceValueObject::make(100),
            'price_old' => PriceValueObject::make(500)
        ], $sale->raw());

        $this->expectException(InvalidArgumentException::class);

        PriceValueObject::make(-10000);
        PriceValueObject::make(10000, -100);
    }
}
