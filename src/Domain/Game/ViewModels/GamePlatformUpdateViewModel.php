<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GamePlatformUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GamePlatform $gamePlatform;

    public function __construct(GamePlatform $gamePlatform = null)
    {
        $this->gamePlatform = $gamePlatform;
    }

    public function gamePlatform(): ?GamePlatform
    {
        return $this->gamePlatform ?? null;
    }

    public function manufacturers(): array
    {
        return GamePlatformManufacturer::all()->select('id', 'name')->pluck('name', 'id')->toArray();
    }

    public function selectedManufacturer(): ?int
    {
        return $this->gamePlatform?->game_platform_manufacturer->id ?? null;
    }

    public function types(): array
    {
        return GamePlatformTypeEnum::cases();
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gamePlatform);
    }
}
