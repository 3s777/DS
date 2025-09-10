<?php

namespace Admin\Game\ViewModels;

use Domain\Game\Models\GameGenre;
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

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gameGenre);
    }
}
