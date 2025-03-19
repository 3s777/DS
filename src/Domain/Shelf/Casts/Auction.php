<?php

namespace Domain\Shelf\Casts;

use Domain\Trade\ValueObjects\AuctionValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Auction implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?AuctionValueObject
    {
        if (is_array(json_decode($value))) {
            return null;
        }

        if ($value) {
            $jsonValue = json_decode($value);

            return new AuctionValueObject(
                price: $jsonValue->price,
                step: $jsonValue->step,
                finished_at: $jsonValue->finished_at,
                country_id: $jsonValue->country_id,
                shipping: $jsonValue->shipping,
                self_delivery: $jsonValue->self_delivery,
                blitz: $jsonValue->blitz,
                renewal: $jsonValue->renewal,
            );
        }

        return null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof AuctionValueObject) {
            $price = $value['price'];
            $step = $value['step'];
            $finished_at = $value['finished_at'];
            $country_id = $value['country_id'];
            $shipping = $value['shipping'];
            $blitz = $value['blitz'] ?? null;
            $renewal = $value['renewal'] ?? null;
            $self_delivery = $value['self_delivery'] ?? false;

            $value = AuctionValueObject::make(
                price:$price,
                step:$step,
                finished_at:$finished_at,
                country_id:$country_id,
                shipping:$shipping,
                self_delivery:$self_delivery,
                blitz:$blitz,
                renewal:$renewal,
            );
        }

        //        $prices = [
        //            'price' => $value->price()->prepareValue()
        //        ];


        return json_encode([
            'price' => $value->price()->prepareValue(),
            'step' => $value->step()->prepareValue(),
            'finished_at' => $value->finished_at(),
            'blitz' => $value->blitz()?->prepareValue(),
            'renewal' => $value->renewal(),
            'country_id' => $value->country_id(),
            'shipping' => $value->shipping(),
            'self_delivery' => $value->self_delivery(),
        ]);
    }
}
