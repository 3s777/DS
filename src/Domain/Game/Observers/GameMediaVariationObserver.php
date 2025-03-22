<?php

namespace Domain\Game\Observers;

use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;

class GameMediaVariationObserver
{
    public function creating(GameMediaVariation $gameMediaVariation): void
    {
    }

    public function updating(GameMediaVariation $gameMediaVariation): void
    {
        if ($gameMediaVariation->is_main) {
            $gameMediaVariation->gameMedia->variations()
                ->where('is_main', true)
                ->whereNot('id', $gameMediaVariation->id)
                ->update(['is_main' => false]);
        }
    }

    public function deleted(GameMediaVariation $gameMediaVariation): void
    {

    }
}
