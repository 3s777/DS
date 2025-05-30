<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Support\Traits\Makeable;

final readonly class FillPermissionDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $display_name,
        public string $guard_name,
        public ?string $description = null
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return static::make(...$request->only([
            'name',
            'display_name',
            'guard_name',
            'description'
        ]));
    }
}
