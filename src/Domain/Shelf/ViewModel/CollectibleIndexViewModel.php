<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Collectible;
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
                'collectibles.category_id',
                'collectibles.sale_data',
                'collectibles.auction_data',
                //                'collectibles.sale',
                //                'collectibles.sale->price',
                //                'collectibles.auction',
                'collectibles.created_at',
                'collectibles.user_id',
                'collectors.name as collector_name'
            )
            ->leftJoin('collectors', 'collectors.id', '=', 'collectibles.collector_id')
            ->with(['collectable:id,name', 'sale', 'auction','category:id,name'])
            ->filteredAdmin()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
