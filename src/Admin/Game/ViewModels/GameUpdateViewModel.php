<?php

namespace Admin\Game\ViewModels;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GameUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

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

    public function selectedGenres(): ?array
    {
        return $this->game?->genres->pluck('id')->toArray() ?? null;
    }

    public function selectedPlatforms(): ?array
    {
        return $this->game?->platforms->pluck('id')->toArray() ?? null;
    }

    public function selectedPublishers(): ?array
    {
        return $this->game?->publishers->pluck('name', 'id')->toArray() ?? null;
    }

    public function selectedDevelopers(): ?array
    {
        return $this->game?->developers->pluck('name', 'id')->toArray() ?? null;
    }

    public function genres(): array
    {
        return GameGenre::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->game);
    }
}
