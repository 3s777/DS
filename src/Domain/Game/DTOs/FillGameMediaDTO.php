<?php

namespace Domain\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillGameMediaDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $article_number = null,
        public ?string $barcodes = null,
        public ?string $alternative_names = null,
        public ?int $user_id = null,
        public ?string $slug = null,
        public ?string $released_at = null,
        public ?array $games = null,
        public ?array $genres = null,
        public ?array $platforms = null,
        public ?array $developers = null,
        public ?array $publishers = null,
        public ?array $kit_items = null,
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
            'article_number',
            'barcodes',
            'alternative_names',
            'user_id',
            'slug',
            'released_at',
            'games',
            'genres',
            'platforms',
            'developers',
            'publishers',
            'kit_items',
            'featured_image',
            'featured_image_uploaded',
            'images',
            'images_delete',
            'description',
        ]));
    }
}
