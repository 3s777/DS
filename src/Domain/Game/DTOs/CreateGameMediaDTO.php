<?php

namespace Domain\Game\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class CreateGameMediaDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?string $articleNumber = null,
        public readonly ?array $barcodes = null,
        public readonly ?array $alternativeNames = null,
        public readonly ?int $user_id = null,
        public readonly ?string $slug = null,
        public readonly ?string $released_at = null,
        public readonly ?array $genres = null,
        public readonly ?array $platforms = null,
        public readonly ?array $developers = null,
        public readonly ?array $publishers = null,
        public readonly ?UploadedFile $thumbnail = null,
        public readonly ?string $description = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'articleNumber',
            'barcodes',
            'alternativeNames',
            'user_id',
            'slug',
            'released_at',
            'genres',
            'platforms',
            'developers',
            'publishers',
            'thumbnail',
            'description',
        ]));
    }
}
