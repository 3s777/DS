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

    private array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        public int|float|PriceValueObject      $price,
        public int|float|null|PriceValueObject $priceOld = null,
        private string        $currency = 'RUB',
        private int           $precision = 100
    ) {
        if($price < 0 || $priceOld < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        $this->setValues();
    }

    private function setValues(): void
    {
//        $this->price = ((int)($this->price * $this->precision)) / $this->precision;
//        $this->priceOld = ((int)($this->priceOld * $this->precision)) / $this->precision;
        $this->price = PriceValueObject::make($this->price);
        $this->priceOld = PriceValueObject::make($this->priceOld);
    }

    public function raw(): array
    {
        return [
            'price' => $this->price,
            'price_old' => $this->priceOld
        ];
    }
//
//    public function values(): array
//    {
//        return [
//            'price' => $this->price / $this->precision,
//            'price_old' => $this->priceOld ? $this->priceOld / $this->precision : null
//        ];
//    }
//
//    public function preparedValues(): array
//    {
//        return [
//            'price' => $this->price * $this->precision,
//            'price_old' => $this->priceOld ? $this->priceOld * $this->precision : null
//        ];
//    }
//
//    public function price()
//    {
//        return $this->values()['price'];
//    }
//
//    public function priceOld()
//    {
//        return $this->values()['price_old'];
//    }
//
//    public function preparePrice()
//    {
//        return $this->preparedValues()['price'];
//    }
//
//    public function preparePriceOld()
//    {
//        return $this->preparedValues()['price_old'];
//    }
//
//    public function viewPrice()
//    {
//        return number_format($this->price(), 2, ',', ' ')
//            . ' ' . $this->symbol();
//    }
//
//    public function viewPriceOld()
//    {
//        return number_format($this->priceOld(), 2, ',', ' ')
//            . ' ' . $this->symbol();
//    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }
}
