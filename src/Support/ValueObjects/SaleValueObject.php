<?php

namespace Support\ValueObjects;

use Domain\Shelf\Casts\Sale;
use Illuminate\Contracts\Database\Eloquent\Castable;
use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

class SaleValueObject
{
    use Makeable;

    public PriceValueObject $price;
    public ? PriceValueObject $priceOld;

    public function __construct(
        int|float $price,
        int|float|null $priceOld = null,
        string $currency = 'RUB',
        int $precision = 100
    ) {
        if($price < 0 || $priceOld < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        $this->setPrices($price, $priceOld, $currency, $precision);
    }

    private function setPrices(int|float $price, int|float|null $priceOld, string $currency, int $precision): void
    {
        $this->price = PriceValueObject::make($price, $currency, $precision);
        $this->priceOld = $priceOld ? PriceValueObject::make($priceOld, $currency, $precision) : null;
    }

    public function raw(): array
    {
        return [
            'price' => $this->price,
            'price_old' => $this->priceOld
        ];
    }

}
