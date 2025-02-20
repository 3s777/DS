<?php

namespace Domain\Shelf\Casts;

use Domain\Trade\ValueObjects\AuctionValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Auction implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?AuctionValueObject
    {
        if(is_array(json_decode($value))) {
            return null;
        }

        if($value) {
            $jsonValue = json_decode($value);

            return new AuctionValueObject(
                $jsonValue->price,
                $jsonValue->step,
                $jsonValue->finished_at,
                $jsonValue->country_id,
                $jsonValue->shipping,
                $jsonValue->self_delivery ?? null,
            );
        }

        return null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if(!$value) {
            return null;
        }

        if(!$value instanceof AuctionValueObject) {
            $price = $value['price'];
            $step = $value['step'];
            $finished_at = $value['finished_at'];
            $country_id = $value['country_id'];
            $shipping = $value['shipping'];
            $self_delivery = (bool)$value['self_delivery'];

            $value = AuctionValueObject::make(
                $price,
                $step,
                $finished_at,
                $country_id,
                $shipping,
                $self_delivery
            );
        }

//        $prices = [
//            'price' => $value->price()->prepareValue()
//        ];

        return json_encode([
            'price' => $value->price()->prepareValue(),
            'step' => $value->step()->prepareValue(),
            'finished_at' => $value->finished_at(),
            'country_id' => $value->country_id(),
            'shipping' => $value->shipping(),
            'self_delivery' => $value->self_delivery(),
        ]);
    }
}
