<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

class NewUserDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly int $language_id,
        public readonly null|string $first_name = null,
        public readonly null|string $slug = null,
        public readonly null|string $description = null,
        public readonly null|UploadedFile $thumbnail = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'email',
            'password',
            'language_id',
            'first_name',
            'slug',
            'description',
            'thumbnail'
        ]));
    }
}
