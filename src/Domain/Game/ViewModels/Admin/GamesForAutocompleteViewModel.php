<?php

namespace Domain\Game\ViewModels\Admin;

use Domain\Game\Models\Game;
use Spatie\ViewModels\ViewModel;

class GamesForAutocompleteViewModel extends ViewModel
{
    public function __construct(
        protected ?array $games,
    ) {
    }

    public function result(): array
    {
        if ($this->games) {
            $games = Game::query()
                ->select(['id'])
                ->with(['developers:id,name', 'publishers:id,name', 'genres:id,name', 'platforms:id,name'])
                ->whereIn('id', $this->games)
                ->get()
                ->toArray();
        }

        return $games ?? [];
    }
}
