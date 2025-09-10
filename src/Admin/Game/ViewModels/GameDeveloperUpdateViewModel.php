<?php

namespace Admin\Game\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GameDeveloperUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GameDeveloper $gameDeveloper;

    public function __construct(GameDeveloper $gameDeveloper = null)
    {
        $this->gameDeveloper = $gameDeveloper;
    }

    public function gameDeveloper(): ?GameDeveloper
    {
        return $this->gameDeveloper ?? null;
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gameDeveloper);
    }
}
