<?php

namespace Admin\Shelf\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillCategoryDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $model,
        public ?string $slug = null,
        public ?string $description = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'model',
            'slug',
            'description'
        ]));
    }
}
