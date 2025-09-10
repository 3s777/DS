<?php

namespace Admin\Shelf\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillShelfDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?int $collector_id = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
        public ?string $description = null,
        public ?int $number = null
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
