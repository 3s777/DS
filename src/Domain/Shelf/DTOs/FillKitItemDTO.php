<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class FillKitItemDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?string $slug = null,
        public readonly ?int $user_id = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'slug',
            'user_id'
        ]));
    }
}
