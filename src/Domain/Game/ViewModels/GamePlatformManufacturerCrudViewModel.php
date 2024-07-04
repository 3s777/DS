<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePlatformManufacturerCrudViewModel extends ViewModel
{
    public ?GamePlatformManufacturer $gamePlatformManufacturer;

    public function __construct(GamePlatformManufacturer $gamePlatformManufacturer = null)
    {
        $this->gamePlatformManufacturer = $gamePlatformManufacturer;
    }

    public function gamePlatformManufacturer(): ?GamePlatformManufacturer
    {
        return $this->gamePlatformManufacturer ?? null;
    }

    public function users(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all()->select('id', 'name');
    }
}
