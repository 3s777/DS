<?php

namespace Domain\Trade\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class FillSaleDTO
{
    use Makeable;

    public function __construct(
        public readonly int $collectible_id,
        public readonly int $price,
        public readonly int $quantity,
        public readonly bool $bidding,
        public readonly int $country_id,
        public readonly string $shipping,
        public readonly bool $self_delivery,
        public readonly string $reservation,
        public readonly ?int $price_old = null,
        public readonly ?array $shipping_countries = null
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
