<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AsyncDepend extends Component
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
        public ?string $label = null,
        public ?string $defaultOption = null,
        public ?array $selected = null,
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = to_dot_name($selectName);
        $this->filteredDependName = to_dot_name($dependOn);
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select.async-depend');
    }
}
