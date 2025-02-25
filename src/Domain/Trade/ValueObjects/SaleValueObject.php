<?php

namespace Domain\Trade\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;
use Support\ValueObjects\PriceValueObject;

class SaleValueObject
{
    use Makeable;

    private PriceValueObject $price;
    private ?PriceValueObject $priceOld;
    private ?bool $bidding;
    private ?int $country_id;
    private ?string $shipping;

    private ?int $quantity;
    private ?string $reservation;
    private ?bool $self_delivery;

    public function __construct(
        int|float $price,
        int $quantity,
        int $country_id,
        string $shipping,
        int|float|null $priceOld = null,
        ?bool $bidding = false,
        ?bool $self_delivery = true,
        ?string $reservation = 'none',
        string $currency = 'RUB',
        int $precision = 100
    ) {
        if($price < 0 || $priceOld < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        $this->setPrices($price, $priceOld, $currency, $precision);

        $this->bidding = $bidding;
        $this->country_id = $country_id;
        $this->shipping = $shipping;
        $this->quantity = $quantity;
        $this->reservation = $reservation;
        $this->self_delivery = $self_delivery;
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

    public function country_id(): ?string
    {
        return $this->country_id;
    }

    public function shipping(): ?string
    {
        return $this->shipping;
    }

    public function reservation(): ?string
    {
        return $this->reservation;
    }

    public function self_delivery(): ?bool
    {
        return $this->self_delivery;
    }

    public function quantity(): ?int
    {
        return $this->quantity;
    }

    public function raw(): array
    {
        return [
            'price' => $this->price,
            'quantity' => $this->quantity,
            'price_old' => $this->priceOld,
            'bidding' => $this->bidding,
            'country_id' => $this->country_id,
            'shipping' => $this->shipping,
            'self_delivery' => $this->self_delivery,
            'reservation' => $this->reservation
        ];
    }

}
