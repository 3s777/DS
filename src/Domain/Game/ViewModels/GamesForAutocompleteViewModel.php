<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\Game;
use Illuminate\Support\Facades\Schema;
use Spatie\ViewModels\ViewModel;

class GamesForAutocompleteViewModel extends ViewModel
{
    public function __construct(
        protected ?array $games,
    )
    {
    }

    public function result()
    {
        if($this->games) {
            $games = Game::query()
                ->select(['id'])
                ->with(['developers:id,name', 'publishers:id,name', 'genres:id,name', 'platforms:id,name'])
                ->whereIn('id', $this->games)
                ->get()
                ->toArray();
        }

        return $games;
    }
}
