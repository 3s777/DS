<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class GameCrudViewModel extends ViewModel
{
    public ?Game $game;

    public function __construct(Game $game = null)
    {
        $this->game = $game;
    }

    public function game(): ?Game
    {
        $this->game?->load(['genres:id,name', 'platforms:id,name', 'developers:id,name', 'publishers:id,name']);
        return $this->game ?? null;
    }

    public function genres(): array
    {
        return GameGenre::select('id', 'name')->get()->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::select('id', 'name')->get()->toArray();
    }

//    public function developers(): array
//    {
//        return GameDeveloper::select('id', 'name')->get()->toArray();
//    }
//
//    public function publishers(): array
//    {
//        return GamePublisher::select('id', 'name')->get()->toArray();
//    }
}
