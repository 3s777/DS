<?php

namespace Domain\Auth\DTOs;

use Domain\Auth\Contracts\NewUserDTOContract;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class NewAdminDTO implements NewUserDTOContract
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $language,
        public ?array $roles = null,
        public ?string $first_name = null,
        public ?string $slug = null,
        public ?string $description = null,
        public ?UploadedFile $featured_image = null,
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
            'first_name',
            'slug',
            'description',
            'featured_image',
            'is_verified'
        ]));
    }
}
