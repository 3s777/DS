<?php

namespace Domain\Game\ViewModels;

use App\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;

class GamePlatformIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function getTypeName($type): string
    {
        return GamePlatformTypeEnum::tryFrom($type)->name();
    }

    public function platforms(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return GamePlatform::query()
            ->select('game_platforms.id', 'game_platforms.name', 'game_platforms.type', 'game_platforms.created_at', 'game_platforms.slug', 'game_platforms.user_id', 'game_platforms.game_platform_manufacturer_id')
            ->with(['user', 'game_platform_manufacturer'])
            ->orderBy('id', 'DESC')
            ->paginate(100)
            ->withQueryString();
    }
}
