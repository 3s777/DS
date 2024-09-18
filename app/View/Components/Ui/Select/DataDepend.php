<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class DataDepend extends Component
{
    public string $filteredName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $selectName,
        public string $dependOn,
        public string $dependField,
        public string $route,
        public array|Collection $options = [],
        public ?string $label = null,
        public ?string $defaultOption = null,
        public ?string $selected = null,
        public string $key = 'id',
        public string $optionName = 'name',
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = Str::of($this->selectName)->replace('[', '.')->remove(']')->value();
    }

    public function isOld(string $key): bool
    {
        if(old($this->filteredName) == $key) {
            return true;
        }

        return false;
    }

    public function isSelected(string $key): bool {
        if($this->selected && !old()) {
            return $key == $this->selected;
        }

        return $this->isOld($key);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.select.data-depend');
    }
}
