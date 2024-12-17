<?php

namespace Domain\Shelf\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Support\ValueObjects\AuctionValueObject;
use Support\ValueObjects\SaleValueObject;

class Properties implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $collectableModel = Relation::getMorphedModel($attributes['collectable_type']);

        $properties = $collectableModel::getProperties($value);

        return $properties;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if(!$value) {
            return null;
        }

        $collectableModel = Relation::getMorphedModel($attributes['collectable_type']);

        $properties = $collectableModel::setProperties($value);

        return json_encode($properties);
    }
}
