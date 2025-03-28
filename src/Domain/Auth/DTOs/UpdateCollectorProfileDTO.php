<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class UpdateCollectorProfileDTO
{
    use Makeable;

    public function __construct(
        public string $language,
        public ?string $current_password = null,
        public ?string $new_password = null,
        public ?string $first_name = null,
        public ?string $description = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'language',
            'current_password',
            'new_password',
            'first_name',
            'description',
            'featured_image',
            'featured_image_uploaded',
        ]));
    }
}
