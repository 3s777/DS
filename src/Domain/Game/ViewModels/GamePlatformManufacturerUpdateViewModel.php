<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GamePlatformManufacturer;
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

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gamePlatformManufacturer);
    }
}
