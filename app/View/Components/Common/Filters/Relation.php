<?php

namespace App\View\Components\Common\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Support\Filters\AbstractFilter;

class Relation extends Component
{
    public function __construct(
        public string $name,
        public ?array $options = null,
        public ?AbstractFilter $filter = null,
        public ?string $placeholder = null,
        public ?string $selectName = null,
    ) {
        $this->filter = $filter ?? get_filter($name);
        $this->placeholder = $placeholder ?? $this->filter->placeholder();
        $this->selectName = $selectName ?? 'filters['.$name.']';
        $this->options = $options ?? $this->filter->getPreparedOptions();
    }

    public function render(): View|Closure|string
    {
        return view('components.common.filters.relation');
    }
}
