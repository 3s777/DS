<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class LanguageSwitcher extends Component
{
    public function __construct()
    {
    }

    public function render(): View|Closure|string
    {
        $current = Route::current();
        $switchers = [];

        foreach(config('app.available_locales') as $locale) {
            $switchers[$locale] = URL::toRoute($current, ['locale' => $locale] + $current->parameters(), true);
        }

        return view('components.common.language-switcher', compact(['switchers']));
    }
}
