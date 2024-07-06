<?php

namespace App\Enums;

enum GamePlatformTypeEnum: string
{
    case Stationary = 'stationary';
    case Portable = 'portable';
    case Universal = 'universal';
    case Arcade = 'arcade';
    case Computer = 'computer';
    case Other = 'other';

    public function name():string {
        return match($this) {
            GamePlatformTypeEnum::Portable => __('game_platform.portable'),
            GamePlatformTypeEnum::Universal => __('game_platform.universal'),
            GamePlatformTypeEnum::Arcade => __('game_platform.arcade'),
            GamePlatformTypeEnum::Computer => __('game_platform.computer'),
            GamePlatformTypeEnum::Other => __('game_platform.other'),
            default => __('game_platform.stationary'),
        };
    }
}
