<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;

class AuctionValueObject
{
    use Makeable;

    private PriceValueObject $price;
    private PriceValueObject $step;
    private string $to;

    public function __construct(
        int|float $price,
        int|float $step,
        string $to,
        $currency = 'RUB',
        $precision = 100
    ) {
        if($price < 0 || $step < 0) {
            throw new InvalidArgumentException('Price or step must be more than zero');
        }

        $this->price = PriceValueObject::make($price, $currency, $precision);
        $this->step = PriceValueObject::make($step, $currency, $precision);
        $this->to = $to;
    }

    public function price(): PriceValueObject
    {
        return $this->price;
    }

    public function step(): PriceValueObject
    {
        return $this->step;
    }

    public function to()
    {
        return $this->to;
    }
}
