<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Game\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\ViewModels\ViewModel;

class CollectibleIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function getConditionName($condition): ?string
    {
        $conditionEnum = ConditionEnum::tryFrom($condition);

        return $conditionEnum?->name();
    }

    public function getTypeName($type): ?string
    {
        $typeClassName = Relation::getMorphedModel($type);
        $typeEnum = CollectibleTypeEnum::tryFrom($typeClassName);

        return $typeEnum?->name();
    }

    public function conditions(): array
    {
        return ConditionEnum::cases();
    }

    public function types(): array
    {
//        $types = [];
//
//        foreach (CollectibleTypeEnum::cases() as $type) {
//            $types[$type->morphName()] = $type->name;
//        }

        return CollectibleTypeEnum::cases();
    }

    public function collectibles()
    {
        return Collectible::query()
            ->select(
                'collectibles.id',
                'collectibles.name',
                'collectibles.article_number',
                'collectibles.condition',
                'collectibles.collectable_id',
                'collectibles.collectable_type',
                'collectibles.kit_conditions',
                'collectibles.purchase_price',
                'collectibles.purchased_at',
                'collectibles.seller',
                'collectibles.additional_field',
                'collectibles.target',
                'collectibles.sale',
                'collectibles.auction',
                'collectibles.created_at',
                'collectibles.user_id',
                'users.name as user_name'
            )
            ->join('users', 'users.id', '=', 'collectibles.user_id')
            ->with('collectable')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
