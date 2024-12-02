<?php

namespace Support\ValueObjects;

use Domain\Shelf\Casts\SaleCast;
use Illuminate\Contracts\Database\Eloquent\Castable;
use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

class SaleValueObject implements Castable
{
    use Makeable;

    private array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        private int $saleFields
    ) {
        if(empty($saleFields)) {
            throw new InvalidArgumentException('Sale must be an array');
        }
    }

    public static function castUsing(array $arguments)
    {
        return SaleCast::class;
    }

    public function raw(): array
    {
        return $this->saleFields;
    }

    public function value(): float|int
    {
        return $this->value / $this->precision;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }
}
