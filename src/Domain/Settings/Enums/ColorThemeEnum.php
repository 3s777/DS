<?php

namespace Domain\Settings\Enums;

enum ColorThemeEnum: string
{
    case Default = 'default';
    case Green = 'green';
    case Light = 'light';
    case Dark = 'dark';

    public function theme(): string
    {
        return match($this) {
            ColorThemeEnum::Green => 'theme_green',
            ColorThemeEnum::Light => 'theme_light theme__opposite_dark',
            ColorThemeEnum::Dark => 'theme_dark',
            default => 'theme_default'
        };
    }
}
