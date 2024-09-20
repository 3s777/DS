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
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $selectName,
        public array|Collection $options,
        public ?string $label = null,
        public ?string $defaultOption = null,
        public array|Collection|null $selected = null,
//        public string $key = 'id',
//        public string $optionName = 'name',
        public bool $required = false,
        public bool $showOld = true
    ) {
        $this->filteredName = Str::of($this->selectName)->replace('[]','')->replace('[', '.')->remove(']')->value();
    }

    public function isOld(string $key): bool
    {
        if(old($this->filteredName) == $key) {
            return true;
        }

        return false;
    }

    public function isSelected(string $key): bool {
        if(!$this->showOld) {
            return false;
        }

        if($this->selected && !old()) {
            if(is_array($this->selected)) {

                return Arr::exists($this->selected, $key);
//                return in_array($key, $this->selected);
            }

//            return $this->selected->contains($this->key, $key);
        }

//        if($this->selected && old()) {
//            return in_array($key, old($this->filteredName, []));
//        }

        return in_array($key, old($this->filteredName, []));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.select.data-multiple');
    }
}
