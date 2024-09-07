<?php

namespace Support\Filters;

class FilterManager
{
    public function __construct(
        protected array $items = []
    ) {
    }

    public function registerFilters(array $items): static
    {
        $this->items = $items;
        return $this;
    }

    public function items(): array
    {
        return $this->items;
    }
}
