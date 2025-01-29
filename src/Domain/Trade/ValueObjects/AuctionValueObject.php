<?php

namespace Domain\Trade\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;
use Support\ValueObjects\PriceValueObject;

class AuctionValueObject
{
    use Makeable;

    private PriceValueObject $price;
    private PriceValueObject $step;
    private string $finished_at;

    public function __construct(
        int|float $price,
        int|float $step,
        string $finished_at,
        $currency = 'RUB',
        $precision = 100
    ) {
        if($price < 0 || $step < 0) {
            throw new InvalidArgumentException('Price or step must be more than zero');
        }

        $this->price = PriceValueObject::make($price, $currency, $precision);
        $this->step = PriceValueObject::make($step, $currency, $precision);
        $this->finished_at = $finished_at;
    }

    public function price(): PriceValueObject
    {
        return $this->price;
    }

    public function step(): PriceValueObject
    {
        return $this->step;
    }

    public function finished_at()
    {
        return $this->finished_at;
    }
}
