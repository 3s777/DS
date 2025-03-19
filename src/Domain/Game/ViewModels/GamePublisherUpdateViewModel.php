<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GamePublisherUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GamePublisher $gamePublisher;

    public function __construct(GamePublisher $gamePublisher = null)
    {
        $this->gamePublisher = $gamePublisher;
    }

    public function gamePublisher(): ?GamePublisher
    {
        return $this->gamePublisher ?? null;
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gamePublisher);
    }
}
