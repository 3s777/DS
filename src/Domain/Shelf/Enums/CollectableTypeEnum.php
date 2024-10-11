<?php

namespace Domain\Shelf\Enums;

enum CollectableTypeEnum: string
{
    case Game = 'Domain\Game\Models\GameMedia';
    case Book = 'Domain\Book\Models\BookMedia';

    public function name():string {
        return match($this) {
            CollectableTypeEnum::Game => trans_choice('game.games', 1),
            CollectableTypeEnum::Book => trans_choice('user.users', 1),
            default => trans_choice('game.games', 1),
        };
    }
}
