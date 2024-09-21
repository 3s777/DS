<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class DataMultiple extends Component
{
    public string $filteredName;

    public function __construct(
        public string $name,
        public string $selectName,
        public array|Collection $options,
        public ?string $label = null,
        public ?string $defaultOption = null,
        public array|Collection|null $selected = null,
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = to_dot_name($selectName);
    }

    public function isSelected(string $key): bool {
        if(!$this->showOld) {
            return false;
        }

        if($this->selected && !old()) {
            return in_array($key, $this->selected);
        }

        return in_array($key, old($this->filteredName, []));
    }


    public function render(): View|Closure|string
    {
        return view('components.ui.select.data-multiple');
    }
}
