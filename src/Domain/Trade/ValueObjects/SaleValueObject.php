<?php

namespace Domain\Trade\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;
use Support\ValueObjects\PriceValueObject;

class SaleValueObject
{
    use Makeable;

    private PriceValueObject $price;
    private ? PriceValueObject $priceOld;
    private ?bool $bidding;

    public function __construct(
        int|float $price,
        int|float|null $priceOld = null,
        string $currency = 'RUB',
        ?bool $bidding = false,
        int $precision = 100
    ) {
        if($price < 0 || $priceOld < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        $this->setPrices($price, $priceOld, $currency, $precision);

        $this->bidding = $bidding;
    }

    private function setPrices(int|float $price, int|float|null $priceOld, string $currency, int $precision): void
    {
        $this->price = PriceValueObject::make($price, $currency, $precision);
        $this->priceOld = $priceOld ? PriceValueObject::make($priceOld, $currency, $precision) : null;
    }

    public function price(): PriceValueObject
    {
        return $this->price;
    }

    public function priceOld(): ?PriceValueObject
    {
        return $this->priceOld;
    }

    public function bidding(): ?bool
    {
        return $this->bidding;
    }

    public function raw(): array
    {
        return [
            'price' => $this->price,
            'price_old' => $this->priceOld,
            'bidding' => $this->bidding
        ];
    }

}
