<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorThemeController extends Controller
{
    public function __invoke($theme)
    {
        switch ($theme) {
            case 2:
                session()->put('color.theme', 'theme_default');
                break;
            case 3:
                session()->put('color.theme', 'theme_green');
                break;
            case 4:
                session()->put('color.theme', 'theme_light theme__opposite_dark');
                break;
            case 5:
                session()->put('color.theme', 'theme_dark');
                break;
            default:
                session()->put('color.theme', 'theme_default');
        }

        return back();
    }
}
