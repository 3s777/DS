<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillCollectibleDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public int $shelf_id,
        public string $condition,
        public array $kit_conditions,
        public string $target,
        public ?int $kit_score = null,
        public ?int $collectable = null,
        public ?string $collectable_type = null,
        public ?string $article_number = null,
        public ?float $purchase_price = null,
        public ?string $purchased_at = null,
        public ?string $seller = null,
        public ?string $additional_field = null,
        public ?array $properties = null,
        public ?array $sale = null,
        public ?array $auction = null,
        public ?int $country_id = null,
        public ?string $shipping = null,
        public ?array $shipping_countries = null,
        public ?bool $self_delivery = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
        public ?array $images = null,
        public ?string $images_delete = null,
        public ?string $description = null,
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
            'kit_score',
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
            'country_id',
            'shipping',
            'shipping_countries',
            'self_delivery',
            'featured_image',
            'featured_image_uploaded',
            'images',
            'images_delete',
            'description'
        ]));
    }
}
