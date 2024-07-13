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
        return $this->game ?? null;
    }

    public function genres(): array
    {
        return GameGenre::all()->select('id', 'name')->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::all()->select('id', 'name')->toArray();
    }

    public function developers(): array
    {
        return GameDeveloper::all()->select('id', 'name')->toArray();
    }

    public function publishers(): array
    {
        return GamePublisher::all()->select('id', 'name')->toArray();
    }
}
