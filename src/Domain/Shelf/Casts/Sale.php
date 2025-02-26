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
                $jsonValue->quantity,
                $jsonValue->country_id,
                $jsonValue->shipping,
                $jsonValue->price_old ?? null,
                $jsonValue->bidding ?? null,
                $jsonValue->self_delivery ?? null,
                $jsonValue->reservation ?? 'none'
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
            $quantity = $value['quantity'];
            $country_id = $value['country_id'];
            $shipping = $value['shipping'];
            $priceOld = $value['price_old'] ?? null;
            $bidding = $value['bidding'] ?? null;
            $self_delivery = $value['self_delivery'] ?? null;
            $reservation = $value['reservation'] ?? 'none';

            $value = SaleValueObject::make(
                $price,
                $quantity,
                $country_id,
                $shipping,
                $priceOld,
                $bidding,
                $self_delivery,
                $reservation
            );
        }

        $sale = [
            'price' => $value->price()->prepareValue(),
            'quantity' => $value->quantity(),
            'country_id' => $value->country_id(),
            'shipping' => $value->shipping(),
            'self_delivery' => $value->self_delivery(),
            'reservation' => $value->reservation(),
            'price_old' => $value->priceOld()?->prepareValue(),
            'bidding' => $value->bidding()
        ];
//
//        if($value->priceOld()) {
//            $sale['price_old'] = $value->priceOld()->prepareValue();
//        }
//
//        if($value->bidding()) {
//            $sale['bidding'] = $value->bidding();
//        }

        return json_encode($sale);
    }
}
