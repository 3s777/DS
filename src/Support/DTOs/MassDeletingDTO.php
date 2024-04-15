<?php

namespace Support\DTOs;

use Support\Traits\Makeable;

class MassDeletingDTO
{
    use Makeable;

    public function __construct(
        public readonly string $modelNamespace,
        public readonly array|string $ids,
        public readonly bool $isForce = false
    )
    {
    }
}
