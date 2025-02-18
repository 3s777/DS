<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataMultipleDepend extends Component
{
    public string $filteredName;
    public string $filteredDependName;

    public function __construct(
        public string $name,
        public string $selectName,
        public string $dependOn,
        public string $dependField,
        public string $route,
        public ?bool $dependDisabled,
        public array $options = [],
        public ?string $label = null,
        public ?string $defaultOption = null,
        public ?array $selected = null,
        public bool $required = false,
        public bool $showOld = true,
        public bool $scripts = true
    ) {
        $this->filteredName = to_dot_name($selectName);
        $this->filteredDependName = to_dot_name($dependOn);
    }

    public function oldValues(): ?string
    {
        $oldValues = '';

        if(old($this->filteredName)) {
            foreach(old($this->filteredName) as $oldValue) {
                $oldValues .= $oldValue.',';
            }
        }

        return $oldValues;
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select.data-multiple-depend');
    }
}
