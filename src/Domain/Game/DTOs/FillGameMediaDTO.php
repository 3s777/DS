<?php

namespace Domain\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class FillGameMediaDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?string $article_number = null,
        public readonly ?string $barcodes = null,
        public readonly ?string $alternative_names = null,
        public readonly ?int $user_id = null,
        public readonly ?string $slug = null,
        public readonly ?string $released_at = null,
        public readonly ?array $games = null,
        public readonly ?array $genres = null,
        public readonly ?array $platforms = null,
        public readonly ?array $developers = null,
        public readonly ?array $publishers = null,
        public readonly ?array $kit_items = null,
        public readonly ?UploadedFile $thumbnail = null,
        public readonly ?string $thumbnail_uploaded = null,
        public readonly ?string $description = null,
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
            'thumbnail',
            'thumbnail_uploaded',
            'description',
        ]));
    }
}
