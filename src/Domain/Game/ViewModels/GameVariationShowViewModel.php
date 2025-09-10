<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameMediaVariation;
use Spatie\ViewModels\ViewModel;

class GameVariationShowViewModel extends ViewModel
{
    public ?GameMediaVariation $gameMediaVariation;

    public function __construct(GameMediaVariation $gameMediaVariation = null)
    {
        $this->gameMediaVariation = $gameMediaVariation;
    }

    public function gameMediaVariation(): ?GameMediaVariation
    {
        return $this->gameMediaVariation ?? null;
    }
}
