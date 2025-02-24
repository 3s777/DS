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

    private ?PriceValueObject $blitz;

    private ?int $renewal;
    private ?string $country_id;
    private ?string $shipping;
    private ?bool $self_delivery;

    public function __construct(
        int|float $price,
        int|float $step,
        string $finished_at,
        null|int|float $blitz,
        ?int $renewal,
        string $country_id,
        string $shipping,
        ?bool $self_delivery = true,
        $currency = 'RUB',
        $precision = 100
    ) {
        if($price < 0 || $step < 0) {
            throw new InvalidArgumentException('Price or step must be more than zero');
        }

        $this->price = PriceValueObject::make($price, $currency, $precision);
        $this->step = PriceValueObject::make($step, $currency, $precision);
        $this->finished_at = $finished_at;
        $this->blitz = PriceValueObject::make($blitz, $currency, $precision);
        $this->renewal = $renewal;
        $this->country_id = $country_id;
        $this->shipping = $shipping;
        $this->self_delivery = $self_delivery;
    }

    public function price(): PriceValueObject
    {
        return $this->price;
    }

    public function step(): PriceValueObject
    {
        return $this->step;
    }

    public function finished_at(): string
    {
        return $this->finished_at;
    }

    public function blitz(): ?PriceValueObject
    {
        return $this->blitz;
    }

    public function renewal(): ?int
    {
        return $this->renewal;
    }

    public function country_id(): ?string
    {
        return $this->country_id;
    }

    public function shipping(): ?string
    {
        return $this->shipping;
    }

    public function self_delivery(): ?bool
    {
        return $this->self_delivery;
    }
}
