<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillRoleDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $display_name,
        public string $guard_name,
        public ?array $permissions_admin = null,
        public ?array $permissions_collector = null,
        public ?string $description = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'display_name',
            'guard_name',
            'permissions_admin',
            'permissions_collector',
            'description'
        ]));
    }
}
