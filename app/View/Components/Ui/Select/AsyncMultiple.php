<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AsyncMultiple extends Component
{
    public string $filteredName;

    public function __construct(
        public string $name,
        public string $selectName,
        public string $route,
        public ?string $label = null,
        public ?string $defaultOption = null,
        public array|null $selected = null,
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = to_dot_name($selectName);
    }


    public function isSelected(string $key): bool {
        if(($this->selected && !old()) || ($this->selected && !$this->showOld)) {
            return in_array($key, $this->selected);
        }

        if(!$this->showOld) {
            return false;
        }

        return in_array($key, old($this->filteredName, []));
    }


    public function render(): View|Closure|string
    {
        return view('components.ui.select.async-multiple');
    }
}