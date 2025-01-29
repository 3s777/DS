<?php

namespace Services\Support\ValueObjects;

use Domain\Trade\ValueObjects\AuctionValueObject;
use InvalidArgumentException;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class AuctionTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function it_all(): void
    {
        $auction = AuctionValueObject::make(100, 20, '2024-10-03');

        $this->assertInstanceOf(AuctionValueObject::class, $auction);
        $this->assertEquals(100, $auction->price()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $auction->price());
        $this->assertEquals(20, $auction->step()->raw());
        $this->assertInstanceOf(PriceValueObject::class, $auction->step());
        $this->assertEquals('2024-10-03', $auction->finished_at());

        $this->expectException(InvalidArgumentException::class);

        PriceValueObject::make(-10000);
        PriceValueObject::make(10000, -100);
    }
}
