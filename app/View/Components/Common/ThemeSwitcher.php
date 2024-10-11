<?php

namespace App\View\Components\Common;

use Closure;
use Domain\Setting\Enums\ColorThemeEnum;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ThemeSwitcher extends Component
{
    public function __construct(public string|null $linkClass = null)
    {
    }

    public function render(): View|Closure|string
    {
        $switchers = [];

        foreach(ColorThemeEnum::cases() as $theme) {
            $switchers[] = $theme->value;
        }

        return view('components.common.theme-switcher', compact(['switchers']));
    }
}
