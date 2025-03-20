<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\KitItem;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GameMediaVariationUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GameMediaVariation $gameMediaVariation;

    public function __construct(GameMediaVariation $gameMediaVariation = null)
    {
        $this->gameMediaVariation = $gameMediaVariation;
    }

    public function gameMediaVariation(): ?GameMediaVariation
    {
        $this->gameMediaVariation?->load(['game_medias:id,name']);
        return $this->gameMediaVariation ?? null;
    }

    public function selectedGameMedia(): ?array
    {
        return $this->gameMediaVariation?->gameMedia->pluck('name', 'id')->toArray() ?? null;
    }

    public function selectedKitItems(): ?array
    {
        return $this->gameMediaVariation?->kitItems->pluck('id')->toArray() ?? null;
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gameMediaVariation);
    }

    public function kitItems(): array
    {
        return KitItem::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }
}
