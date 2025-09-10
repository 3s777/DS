<?php

namespace Admin\Game\ViewModels;

use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\KitItem;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class GameMediaUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?GameMedia $gameMedia;

    public function __construct(GameMedia $gameMedia = null)
    {
        $this->gameMedia = $gameMedia;
    }

    public function gameMedia(): ?GameMedia
    {
        $this->gameMedia?->load([
            'genres:id,name',
            'platforms:id,name',
            'developers:id,name',
            'publishers:id,name',
            'games:id,name',
            'mainVariation:id,name,is_main,game_media_id',
            'variations'
        ]);
        return $this->gameMedia ?? null;
    }

    public function selectedGenres(): ?array
    {
        return $this->gameMedia?->genres->pluck('id')->toArray() ?? null;
    }

    public function selectedPlatforms(): ?array
    {
        return $this->gameMedia?->platforms->pluck('id')->toArray() ?? null;
    }

    public function selectedGames(): ?array
    {
        return $this->gameMedia?->games->pluck('name', 'id')->toArray() ?? null;
    }

    public function selectedPublishers(): ?array
    {
        return $this->gameMedia?->publishers->pluck('name', 'id')->toArray() ?? null;
    }

    public function selectedDevelopers(): ?array
    {
        return $this->gameMedia?->developers->pluck('name', 'id')->toArray() ?? null;
    }

    public function selectedKitItems(): ?array
    {
        return $this->gameMedia?->kitItems->pluck('id')->toArray() ?? null;
    }

    public function genres(): array
    {
        return GameGenre::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->gameMedia);
    }

    public function kitItems(): array
    {
        return KitItem::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }
}
