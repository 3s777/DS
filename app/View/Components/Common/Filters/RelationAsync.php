<?php

namespace App\View\Components\Common\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Support\Filters\AbstractFilter;
use Support\Filters\FilterManager;

class RelationAsync extends Component
{
    public function __construct(
        public string $name,
        public string $route,
        public AbstractFilter $filter,
        public string $placeholder = '',
        public string $selectName = '',
    ) {

    }

    public function render(): View|Closure|string
    {
        return view('components.common.filters.relation-async');
    }
}
