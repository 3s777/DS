<?php

namespace Domain\Shelf\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Support\ValueObjects\SaleValueObject;

class Sale implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?SaleValueObject
    {
        if(is_array(json_decode($value))) {
            return null;
        }

        if($value) {
            $jsonValue = json_decode($value);

            return new SaleValueObject(
                $jsonValue->price,
                $jsonValue->price_old ?? null
            );
        }

        return null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if(!$value) {
            return null;
        }

        if(!$value instanceof SaleValueObject) {
            $price = $value['price'];
            $priceOld = $value['price_old'] ?: null;

            $value = SaleValueObject::make($price, $priceOld);
        }

        return json_encode([
            'price' => $value->preparePrice(),
            'price_old' => $value->preparePriceOld(),
        ]);
    }
}
