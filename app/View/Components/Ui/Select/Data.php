<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Data extends Component
{
    public string $filteredName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $selectName,
        public array $options,
        public ?string $label = null,
        public ?string $defaultOption = null,
        public ?string $selected = null,
        public bool $required = false,
        public bool $showOld = true,
        public bool $scripts = true
    ) {
        $this->filteredName = to_dot_name($selectName);
    }

    public function isOld(string $key): bool
    {
        if (old($this->filteredName) == $key) {
            return true;
        }

        return false;
    }

    public function isSelected(string $key): bool
    {
        if (($this->selected && !old()) || ($this->selected && !$this->showOld)) {
            return $key == $this->selected;
        }

        if (!$this->showOld) {
            return false;
        }

        return $this->isOld($key);
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select.data');
    }
}
