<?php

namespace Domain\Game\DTOs;

use Support\Traits\Makeable;

class ApiGamesDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly array $alternative_names,
        public readonly string $released,
        public readonly string $description,
        public readonly array $publishers,
        public readonly array $developers,
        public readonly array $genres,
        public readonly array $platforms,
    )
    {
    }
}
