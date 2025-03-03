<?php

namespace Domain\Game\Enums;

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
            GamePlatformTypeEnum::Portable => __('game.platform.portable'),
            GamePlatformTypeEnum::Universal => __('game.platform.universal'),
            GamePlatformTypeEnum::Arcade => __('game.platform.arcade'),
            GamePlatformTypeEnum::Computer => __('game.platform.computer'),
            GamePlatformTypeEnum::Other => __('game.platform.other'),
            default => __('game.platform.stationary'),
        };
    }
}
