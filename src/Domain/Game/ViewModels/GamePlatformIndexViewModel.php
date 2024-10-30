<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;

class GamePlatformIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function getTypeName($type): ?string
    {
        $gameTypeEnum = GamePlatformTypeEnum::tryFrom($type);

        return $gameTypeEnum?->name();
    }

    public function platforms(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return GamePlatform::query()
            ->select(
                'game_platforms.id',
                'game_platforms.name',
                'game_platforms.type',
                'game_platforms.created_at',
                'game_platforms.slug',
                'game_platforms.user_id',
                'game_platforms.game_platform_manufacturer_id',
                'users.name as user_name',
                'game_platform_manufacturers.name as manufacturer_name'
            )
            ->join('users', 'users.id', '=', 'game_platforms.user_id')
            ->leftJoin('game_platform_manufacturers', 'game_platform_manufacturers.id', '=', 'game_platforms.game_platform_manufacturer_id')
//            ->with(['game_platform_manufacturer'])
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
