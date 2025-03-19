<?php

namespace Domain\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillGameDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?int $user_id = null,
        public ?string $slug = null,
        public ?string $released_at = null,
        public ?array $genres = null,
        public ?array $platforms = null,
        public ?array $developers = null,
        public ?array $publishers = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
        public ?array $images = null,
        public ?string $images_delete = null,
        public ?string $description = null,
        public ?string $alternative_names = null
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
            'featured_image',
            'featured_image_uploaded',
            'images',
            'images_delete',
            'description',
            'alternative_names'
        ]));
    }
}
