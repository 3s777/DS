<?php

namespace Support\DTOs;

use Support\Traits\Makeable;

final readonly class MassDeletingDTO
{
    use Makeable;

    public function __construct(
        public string $modelNamespace,
        public array|string $ids,
        public bool $isForce = false
    ) {
    }
}
