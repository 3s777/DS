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
        public readonly int $language_id,
        public readonly array $roles,
        public readonly ?array $permissions = null,
        public readonly ?string $password = null,
        public readonly ?string $first_name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?UploadedFile $thumbnail = null,
        public readonly ?string $thumbnail_uploaded = null,
        public readonly ?int $is_verified = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'email',
            'password',
            'language_id',
            'roles',
            'permissions',
            'first_name',
            'slug',
            'description',
            'thumbnail',
            'thumbnail_uploaded',
            'is_verified'
        ]));
    }
}
