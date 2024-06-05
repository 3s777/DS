<?php

namespace App\ViewModels\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Spatie\ViewModels\ViewModel;

class GameDeveloperCreateViewModel extends ViewModel
{
    public ?GameDeveloper $gameDeveloper;

    public function __construct(GameDeveloper $gameDeveloper = null)
    {
        $this->gameDeveloper = $gameDeveloper;
    }

    public function gameDeveloper(): ?GameDeveloper
    {
        return $this->gameDeveloper ?? null;
    }

    public function users(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all()->select('id', 'name');
    }
}
