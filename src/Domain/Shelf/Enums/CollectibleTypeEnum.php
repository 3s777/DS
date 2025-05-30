<?php

namespace Domain\Shelf\Enums;

enum CollectibleTypeEnum: string
{
    case Game = 'Domain\Game\Models\GameMediaVariation';
    case Book = 'Domain\Book\Models\BookMedia';

    public function name(): string
    {
        return match($this) {
            CollectibleTypeEnum::Game => trans_choice('game.games', 1),
            CollectibleTypeEnum::Book => trans_choice('user.users', 1),
            default => trans_choice('game.games', 1),
        };
    }

    public function morphName(): string
    {
        return match($this) {
            CollectibleTypeEnum::Game => 'game_media_variation',
            CollectibleTypeEnum::Book => 'book',
            default => 'game_media_variation',
        };
    }
}
