<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

final readonly class PriceValueObject implements Stringable
{
    use Makeable;

    public function __construct(
        private int|float $value,
        private string $currency = 'RUB',
        private int $precision = 100,
        private array $currencies  =  ['RUB' => '₽']
    ) {
        if($value < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        if(!isset($this->currencies[$currency])) {
            throw new InvalidArgumentException('Currency not allowed');
        }
    }

    // Cut off the extra digits after the decimal point and round them up again for validation
    private function validatedValue(): float|int
    {
        return ((int)($this->value * $this->precision)) / $this->precision;
    }

    public function raw(): float|int
    {
        return $this->validatedValue();
    }

    public function prepareValue(): int
    {
        return $this->validatedValue() * $this->precision;
    }

    public function value(): float|int
    {
        return $this->validatedValue() / $this->precision;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }

    public function __toString()
    {
        return number_format($this->value(), 2, ',', ' ')
            . ' ' . $this->symbol();
    }
}
