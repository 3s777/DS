<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class LanguageSwitcher extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $current = Route::current();
        $localeRoutes = [];
        foreach(config('app.available_locales') as $locale) {
            $localeRoutes[] = [
                'name' => $locale,
                'url' => URL::toRoute($current, ['locale' => $locale] + $current->parameters(), true),
                'icon' => "svg.flags.".$locale
            ];
        }

        return view('components.common.language-switcher', compact(['localeRoutes']));
    }
}
