<?php

namespace Domain\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class FillGameDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?int $user_id = null,
        public readonly ?string $slug = null,
        public readonly ?string $released_at = null,
        public readonly ?array $genres = null,
        public readonly ?array $platforms = null,
        public readonly ?array $developers = null,
        public readonly ?array $publishers = null,
        public readonly ?UploadedFile $featured_image = null,
        public readonly ?string $featured_image_uploaded = null,
        public readonly ?string $description = null,
        public readonly ?string $alternative_names = null
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
            'description',
            'alternative_names'
        ]));
    }
}
