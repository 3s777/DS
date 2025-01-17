<?php

namespace App\View\Components\Ui\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Enum extends Component
{
    public string $filteredName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $selectName,
        public array|Collection $options,
        public bool $nameAsValue = false,
        public ?string $valueMethod = null,
        public ?string $label = null,
        public ?string $defaultOption = null,
        public string|array|null $selected = null,
        public bool $required = false,
        public bool $multiple = false,
        public bool $scripts = true
    ) {
        $this->filteredName = Str::of($this->selectName)
            ->replace('[]','')
            ->replace('[', '.')
            ->remove(']')
            ->value();
    }

    public function isOld(string $key): bool
    {
        if(is_array(old($this->filteredName))) {
            return in_array($key, old($this->filteredName));
        }

        if(old($this->filteredName) == $key) {
            return true;
        }

        return false;
    }

    public function isSelected(string $key): bool {
        if(is_array($this->selected) && !old()) {
            return in_array($key, $this->selected);
        }

        if($this->selected && !old()) {
            return $key == $this->selected;
        }

        return $this->isOld($key);
    }

    public function getValue($enum): string
    {
        if($this->valueMethod) {
            return call_user_func(array($enum, $this->valueMethod));
        }

        if($this->nameAsValue) {
            return $enum->name;
        }

        return  $enum->value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.select.enum');
    }
}
