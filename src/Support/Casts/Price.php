<?php

namespace Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Support\ValueObjects\PriceValueObject;

class Price implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?PriceValueObject
    {
        if($value) {
            return PriceValueObject::make($value);
        }

        return null;
    }

    public function set($model, string $key, $value, array $attributes): ?int
    {
        if(!$value) {
          return null;
        }

        if(!$value instanceof PriceValueObject) {
            $value = PriceValueObject::make($value);
        }

        return $value->prepareValue();
    }
}
