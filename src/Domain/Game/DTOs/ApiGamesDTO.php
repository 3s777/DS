<?php

namespace Domain\Game\DTOs;

use Support\Traits\Makeable;

final readonly class ApiGamesDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public array $alternative_names,
        public string $released,
        public string $description,
        public array $publishers,
        public array $developers,
        public array $genres,
        public array $platforms,
    ) {
    }
}
