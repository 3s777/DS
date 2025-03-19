<?php

namespace Domain\Trade\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillAuctionDTO
{
    use Makeable;

    public function __construct(
        public int $collectible_id,
        public int $price,
        public int $step,
        public string $finished_at,
        public int $country_id,
        public string $shipping,
        public bool $self_delivery,
        public ?int $blitz = null,
        public ?int $renewal = null,
        public ?array $shipping_countries = null
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
