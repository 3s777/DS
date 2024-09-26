<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataDepend extends Component
{
    public string $filteredName;
    public string $filteredDependName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $selectName,
        public string $dependOn,
        public string $dependField,
        public string $route,
        public array $options = [],
        public ?string $label = null,
        public ?string $defaultOption = null,
        public ?string $selected = null,
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = to_dot_name($selectName);
        $this->filteredDependName = to_dot_name($dependOn);
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select.data-depend');
    }
}
