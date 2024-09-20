<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;

class GameMediaUpdateViewModel extends ViewModel
{
    public ?GameMedia $gameMedia;

    public function __construct(GameMedia $gameMedia = null)
    {
        $this->gameMedia = $gameMedia;
    }

    public function gameMedia(): ?GameMedia
    {
        $this->gameMedia?->load(['genres:id,name', 'platforms:id,name', 'developers:id,name', 'publishers:id,name', 'games:id,name']);
        return $this->gameMedia ?? null;
    }

    public function genres(): array
    {
        return GameGenre::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }
}
