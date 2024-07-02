<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GameGenreCrudViewModel extends ViewModel
{
    public ?GameGenre $gameGenre;

    public function __construct(GameGenre $gameGenre = null)
    {
        $this->gameGenre = $gameGenre;
    }

    public function gameGenre(): ?GameGenre
    {
        return $this->gameGenre ?? null;
    }

    public function users(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all()->select('id', 'name');
    }
}
