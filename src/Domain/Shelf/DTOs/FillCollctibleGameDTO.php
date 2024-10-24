<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class FillCollctibleGameDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly int $user_shelf,
        public readonly int $shelf_id,
        public readonly string $condition,
        public readonly int $media,
        public readonly array $kit_conditions,
        public readonly ?string $article_number = null,
        public readonly ?int $price = null,
        public readonly ?string $purchased_at = null,
        public readonly ?int $user_id = null,
        public readonly ?string $additional_field = null,
        public readonly bool $is_done = false,
        public readonly bool $is_digital = false,
        public readonly ?string $target = null,
        public readonly ?int $sale_price = null,
        public readonly ?int $auction_price = null,
        public readonly ?int $auction_step = null,
        public readonly ?string $auction_to = null,
        public readonly ?UploadedFile $thumbnail = null,
        public readonly ?string $thumbnail_uploaded = null,
        public readonly ?string $description = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'user_id',
            'slug',
            'released_at',
            'genres',
            'platforms',
            'developers',
            'publishers',
            'thumbnail',
            'thumbnail_uploaded',
            'description',
            'alternative_names'
        ]));
    }
}
