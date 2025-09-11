<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Domain\Settings\Enums\ColorThemeEnum;

class ColorThemeController extends Controller
{
    public function __invoke($theme)
    {
        if (ColorThemeEnum::tryFrom($theme)) {
            session()->put('color.theme', ColorThemeEnum::from($theme)->theme());
        }

        return back();
    }
}
