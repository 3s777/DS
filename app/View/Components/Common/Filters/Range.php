<?php

namespace App\View\Components\Common\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Support\Filters\AbstractFilter;

class Range extends Component
{
    public function __construct(
        public string $name,
        public ?AbstractFilter $filter = null,
        public ?string $placeholder = null,
    ) {
        $this->filter = $filter ?? get_filter($name);
        $this->placeholder = $placeholder ?? $this->filter->placeholder();
    }

    public function render(): View|Closure|string
    {
        return view('components.common.filters.range');
    }
}
