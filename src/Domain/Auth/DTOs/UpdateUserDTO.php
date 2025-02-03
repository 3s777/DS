<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class UpdateUserDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $language,
        public readonly array $roles,
        public readonly ?array $permissions = null,
        public readonly ?string $password = null,
        public readonly ?string $first_name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?UploadedFile $featured_image = null,
        public readonly ?bool $featured_image_uploaded = null,
        public readonly ?int $is_verified = null
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
