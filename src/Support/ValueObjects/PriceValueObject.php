<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

class PriceValueObject implements Stringable
{
    use Makeable;

    private array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        private int|float $value,
        private string $currency = 'RUB',
        private int $precision = 100
    ) {
        if($value < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        if(!isset($this->currencies[$currency])) {
            throw new InvalidArgumentException('Currency not allowed');
        }

        $this->setValue();
    }

    private function setValue(): void
    {
        $this->value = ((int)($this->value * $this->precision)) / $this->precision;
    }

    public function raw(): float|int
    {
        return $this->value;
    }

    public function prepareValue(): int
    {
        return $this->value * $this->precision;
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

    public function __toString()
    {
        return number_format($this->value(), 2, ',', ' ')
            . ' ' . $this->symbol();
    }
}
