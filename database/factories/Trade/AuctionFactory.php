<?php

namespace Database\Factories\Trade;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Trade\Models\Auction>
 */
class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(1, 10000),
            'step' => fake()->numberBetween(1, 10),
            'finished_at' => fake()->dateTime(),
            'blitz' => fake()->numberBetween(1, 10000),
            'renewal' => fake()->numberBetween(1, 10),
            'country_id' => Country::factory()->create(),
            'shipping' => Arr::random(ShippingEnum::cases())->value,
            'self_delivery' => fake()->boolean,
        ];
    }
}
