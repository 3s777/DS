<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class LoginUserDTO
{
    use Makeable;

    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $remember = false
    )
    {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only(['email', 'password', 'remember']));
    }
}
