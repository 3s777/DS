<?php

namespace Domain\Game\ViewModels;

use App\Enums\GamePlatformTypeEnum;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePlatformUpdateViewModel extends ViewModel
{
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

    public function users(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all()->select('id', 'name');
    }

    public function types(): array
    {
        return GamePlatformTypeEnum::cases();
    }
}
