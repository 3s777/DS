<?php

namespace Database\Factories\Trade;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Trade\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(1, 10000),
            'price_old' => fake()->numberBetween(1, 10000),
            'quantity' => fake()->numberBetween(1, 100),
            'country_id' => Country::factory()->create(),
            'shipping' => Arr::random(ShippingEnum::cases())->value,
            'reservation' => Arr::random(ReservationEnum::cases())->value,
            'self_delivery' => fake()->boolean,
            'bidding' => fake()->boolean
        ];
    }
}
