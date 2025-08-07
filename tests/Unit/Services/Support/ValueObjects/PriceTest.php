<?php

namespace Services\Support\ValueObjects;

use InvalidArgumentException;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class PriceTest extends TestCase
{

    public function test_all(): void
    {
        $price = PriceValueObject::make(10000);

        $this->assertInstanceOf(PriceValueObject::class, $price);
        $this->assertSame(100, $price->value());
        $this->assertSame(10000, $price->raw());
        $this->assertSame('RUB', $price->currency());
        $this->assertSame('₽', $price->symbol());
        $this->assertEquals('100,00 ₽', $price);

        $this->expectException(InvalidArgumentException::class);

        PriceValueObject::make(-10000);
        PriceValueObject::make(10000, 'USD');
    }
}
