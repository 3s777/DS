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
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
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
                'collectibles.kit_score',
                'collectibles.kit_conditions',
                'collectibles.purchase_price',
                'collectibles.purchased_at',
                'collectibles.seller',
                'collectibles.additional_field',
                'collectibles.target',
//                'collectibles.sale',
//                'collectibles.sale->price',
//                'collectibles.auction',
                'collectibles.created_at',
                'collectibles.user_id',
                'collectors.name as collector_name'
            )
            ->leftJoin('collectors', 'collectors.id', '=', 'collectibles.collector_id')
            ->with(['collectable', 'sale', 'auction'])
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
