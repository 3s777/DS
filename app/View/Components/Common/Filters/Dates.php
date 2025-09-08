<?php

namespace App\View\Components\Common\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Support\Filters\AbstractFilter;

class Dates extends Component
{
    public function __construct(
        public string $name = 'dates',
        public string $direction = 'from',
        public ?AbstractFilter $filter = null,
    ) {
        $this->filter = $filter ?? get_filter($name);
    }

    public function render(): View|Closure|string
    {
        return view('components.common.filters.dates');
    }
}
