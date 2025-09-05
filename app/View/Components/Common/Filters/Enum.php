<?php

namespace App\View\Components\Common\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Support\Filters\AbstractFilter;

class Enum extends Component
{
    public function __construct(
        public mixed $name,
        public ?AbstractFilter $filter = null,
        public ?array $options = null,
        public bool $multiple = false,
        public ?string $placeholder = null,
        public bool $valueMethod = false
    ) {
        $this->filter = $filter ?? get_filter($name);
        $this->options = $filter->options();
        $this->placeholder = $filter->placeholder();
    }

    public function render(): View|Closure|string
    {
        return view('components.common.filters.enum');
    }
}
