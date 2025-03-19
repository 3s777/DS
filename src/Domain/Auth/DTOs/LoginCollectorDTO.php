<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class LoginCollectorDTO
{
    use Makeable;

    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only(['email', 'password', 'remember']));
    }
}
