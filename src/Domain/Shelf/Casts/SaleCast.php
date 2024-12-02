<?php

namespace Domain\Shelf\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Support\ValueObjects\SaleValueObject;

class SaleCast implements CastsAttributes
{
    /**
     * Преобразовать значение к пользовательскому типу.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): SaleValueObject
    {
        return new SaleValueObject(
            $attributes['sale']['price'],
            $attributes['sale']['price_old']
        );
    }

    /**
     * Подготовить переданное значение к сохранению.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, string>
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (! $value instanceof SaleValueObject) {
            throw new InvalidArgumentException('The given value is not an Address instance.');
        }

        return [
            'address_line_one' => $value->lineOne,
            'address_line_two' => $value->lineTwo,
        ];
    }
}
{

}
