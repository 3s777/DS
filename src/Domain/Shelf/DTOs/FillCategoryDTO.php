<?php

namespace Domain\Shelf\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class FillCategoryDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'slug',
            'description'
        ]));
    }
}
