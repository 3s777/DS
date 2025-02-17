<?php

namespace Domain\Shelf\Casts;

use Domain\Trade\ValueObjects\SaleValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

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
                $jsonValue->price_old ?? null,
                bidding: $jsonValue->bidding ?? null
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
            $priceOld = $value['price_old'] ?? null;
            $bidding = $value['bidding'] ?? null;

            $value = SaleValueObject::make($price, $priceOld, bidding: $bidding);
        }

        $sale = [
            'price' => $value->price()->prepareValue()
        ];

        if($value->priceOld()) {
            $sale['price_old'] = $value->priceOld()->prepareValue();
        }

        if($value->bidding()) {
            $sale['bidding'] = $value->bidding();
        }

        return json_encode($sale);
    }
}
