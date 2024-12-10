<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;

class AuctionValueObject
{
    use Makeable;

    public PriceValueObject $price;
    public int|float $step;
    public string $to;

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
        $this->step = $step;
        $this->to = $to;
    }
}
