<?php

namespace Domain\Page\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillPageCategoryDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $slug = null,
        public ?string $description = null,
        public ?int $user_id = null,
        public ?int $parent_id = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'slug',
            'description',
            'user_id',
            'parent_id'
        ]));
    }
}
