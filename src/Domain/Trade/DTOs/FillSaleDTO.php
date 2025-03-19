<?php

namespace Domain\Trade\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillSaleDTO
{
    use Makeable;

    public function __construct(
        public int $collectible_id,
        public int $price,
        public int $quantity,
        public bool $bidding,
        public int $country_id,
        public string $shipping,
        public bool $self_delivery,
        public string $reservation,
        public ?int $price_old = null,
        public ?array $shipping_countries = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'collectible_id',
            'price',
            'quantity',
            'bidding',
            'country_id',
            'shipping',
            'self_delivery',
            'reservation',
            'price_old',
            'shipping_countries'
        ]));
    }
}
