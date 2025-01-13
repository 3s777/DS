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
        public readonly array $kit_conditions,
        public readonly string $target,
        public readonly ?int $collectable = null,
        public readonly ?string $collectable_type = null,
        public readonly ?string $article_number = null,
        public readonly ?float $purchase_price = null,
        public readonly ?string $purchased_at = null,
        public readonly ?string $seller = null,
        public readonly ?string $additional_field = null,
        public readonly ?array $properties = null,
        public readonly ?array $sale = null,
        public readonly ?array $auction = null,
        public readonly ?UploadedFile $featured_image = null,
        public readonly ?bool $featured_image_uploaded = null,
        public readonly ?array $images = null,
        public readonly ?string $images_delete = null,
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
            'collectable',
            'collectable_type',
            'kit_conditions',
            'article_number',
            'purchase_price',
            'purchased_at',
            'seller',
            'additional_field',
            'properties',
            'target',
            'sale',
            'auction',
            'featured_image',
            'featured_image_uploaded',
            'images',
            'images_delete',
            'description'
        ]));
    }
}
