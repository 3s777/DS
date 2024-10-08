<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GamePlatformManufacturerUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GamePlatformManufacturer $gamePlatformManufacturer;

    public function __construct(GamePlatformManufacturer $gamePlatformManufacturer = null)
    {
        $this->gamePlatformManufacturer = $gamePlatformManufacturer;
    }

    public function gamePlatformManufacturer(): ?GamePlatformManufacturer
    {
        return $this->gamePlatformManufacturer ?? null;
    }

    public function selectedUser(): array {
        return $this->getSelectedUser($this->gamePlatformManufacturer);
    }
}
