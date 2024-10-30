<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class FillCollectibleDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly int $shelf_id,
        public readonly string $condition,
        public readonly int $media,
        public readonly array $kit_conditions,
        public readonly ?string $article_number = null,
        public readonly ?float $purchase_price = null,
        public readonly ?string $purchased_at = null,
        public readonly ?string $seller = null,
        public readonly ?int $user_id = null,
        public readonly ?string $additional_field = null,
        public readonly ?array $properties = null,
        public readonly ?string $target = null,
        public readonly ?array $sale = null,
        public readonly ?array $auction = null,
        public readonly ?UploadedFile $thumbnail = null,
        public readonly ?string $thumbnail_uploaded = null,
        public readonly ?string $description = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'user_shelf',
            'shelf_id',
            'condition',
            'media',
            'kit_conditions',
            'article_number',
            'purchase_price',
            'purchase_at',
            'seller',
            'user_id',
            'additional_field',
            'properties',
            'target',
            'sale',
            'auction',
            'thumbnail',
            'thumbnail_uploaded',
            'description'
        ]));
    }
}
