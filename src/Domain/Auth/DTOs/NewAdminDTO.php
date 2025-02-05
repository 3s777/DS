<?php

namespace Domain\Auth\DTOs;

use Domain\Auth\Contracts\NewUserDTOContract;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class NewAdminDTO implements NewUserDTOContract
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $language,
        public readonly ?array $roles = null,
        public readonly ?string $first_name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?UploadedFile $featured_image = null,
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
            'first_name',
            'slug',
            'description',
            'featured_image',
            'is_verified'
        ]));
    }
}
