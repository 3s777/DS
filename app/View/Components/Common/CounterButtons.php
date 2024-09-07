<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CounterButtons extends Component
{
    public function __construct(
        public string $buttonClass,
        public string $badgeClass,
        public string $type = 'standard',
    ) {
        if($type == 'light') {
            $this->buttonClass = $buttonClass. ' counter-buttons__button_light';
            $this->badgeClass = $badgeClass. ' counter-buttons__badge_light';
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.common.counter-buttons');
    }
}
