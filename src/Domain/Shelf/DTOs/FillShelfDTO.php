<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class FillShelfDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?int $collector_id = null,
        public readonly ?UploadedFile $featured_image = null,
        public readonly ?bool $featured_image_uploaded = null,
        public readonly ?string $description = null,
        public readonly ?int $number = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'collector_id',
            'featured_image',
            'featured_image_uploaded',
            'description',
            'number'
        ]));
    }
}
