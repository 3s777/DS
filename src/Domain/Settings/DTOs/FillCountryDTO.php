<?php

namespace Domain\Settings\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class FillCountryDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly ?string $slug = null,
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
