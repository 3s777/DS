<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePublisherCrudViewModel extends ViewModel
{
    public ?GamePublisher $gamePublisher;

    public function __construct(GamePublisher $gamePublisher = null)
    {
        $this->gamePublisher = $gamePublisher;
    }

    public function gamePublisher(): ?GamePublisher
    {
        return $this->gamePublisher ?? null;
    }

    public function users(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all()->select('id', 'name');
    }
}
