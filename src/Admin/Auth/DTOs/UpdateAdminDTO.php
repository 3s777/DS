<?php

namespace Admin\Auth\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class UpdateAdminDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $email,
        public string $language,
        public array $roles,
        public ?array $permissions = null,
        public ?string $password = null,
        public ?string $first_name = null,
        public ?string $slug = null,
        public ?string $description = null,
        public ?UploadedFile $featured_image = null,
        public ?bool $featured_image_uploaded = null,
        public ?int $is_verified = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'email',
            'password',
            'language',
            'roles',
            'permissions',
            'first_name',
            'slug',
            'description',
            'featured_image',
            'featured_image_uploaded',
            'is_verified'
        ]));
    }
}
