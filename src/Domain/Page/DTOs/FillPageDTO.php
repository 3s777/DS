<?php

namespace Domain\Page\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillPageDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $slug = null,
        public ?string $description = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'slug',
            'description',
            'featured_image',
            'featured_image_uploaded',
        ]));
    }
}
