<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillKitItemDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $slug = null,
        public ?int $user_id = null,
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
