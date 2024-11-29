<?php

namespace Services\Support\ValueObjects;

use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class PriceTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function it_all(): void
    {
        $price = PriceValueObject::make(10000);

        $this->assertInstanceOf(PriceValueObject::class, $price);
        $this->assertEquals(100, $price->value());
        $this->assertEquals(10000, $price->raw());
        $this->assertEquals('RUB', $price->currency());
        $this->assertEquals('₽', $price->symbol());
        $this->assertEquals('100,00 ₽', $price);

        $this->expectException(\InvalidArgumentException::class);

        PriceValueObject::make(-10000);
        PriceValueObject::make(10000, 'USD');
    }
}
