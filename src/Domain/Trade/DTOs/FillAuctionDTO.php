<?php

namespace Domain\Trade\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class FillAuctionDTO
{
    use Makeable;

    public function __construct(
        public readonly int $collectible_id,
        public readonly int $price,
        public readonly int $step,
        public readonly string $finished_at,
        public readonly int $country_id,
        public readonly string $shipping,
        public readonly bool $self_delivery,
        public readonly ?int $blitz = null,
        public readonly ?int $renewal = null,
        public readonly ?array $shipping_countries = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'collectible_id',
            'price',
            'step',
            'finished_at',
            'country_id',
            'shipping',
            'self_delivery',
            'blitz',
            'renewal',
            'shipping_countries'
        ]));
    }
}
