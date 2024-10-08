<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GameGenreUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GameGenre $gameGenre;

    public function __construct(GameGenre $gameGenre = null)
    {
        $this->gameGenre = $gameGenre;
    }

    public function gameGenre(): ?GameGenre
    {
        return $this->gameGenre ?? null;
    }

    public function selectedUser(): array {
        return $this->getSelectedUser($this->gameGenre);
    }
}
