<?php

namespace Admin\Settings\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final readonly class FillCountryDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $slug = null,
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'slug',
        ]));
    }
}
