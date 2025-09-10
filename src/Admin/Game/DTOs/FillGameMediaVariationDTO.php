<?php

namespace Admin\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillGameMediaVariationDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?int $game_media_id,
        public ?string $article_number = null,
        public ?string $barcodes = null,
        public ?string $alternative_names = null,
        public ?int $user_id = null,
        public ?string $slug = null,
        public ?array $kit_items = null,
        public null|string|UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
        public ?array $images = null,
        public ?string $images_delete = null,
        public ?string $description = null,
        public bool $is_main = false,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'game_media_id',
            'article_number',
            'barcodes',
            'alternative_names',
            'user_id',
            'slug',
            'kit_items',
            'featured_image',
            'featured_image_uploaded',
            'images',
            'images_delete',
            'description',
            'is_main'
        ]));
    }
}
