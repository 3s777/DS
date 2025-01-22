<?php

namespace Database\Factories\Trade;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Trade\Models\Auction>
 */
class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(100, 1000000),
            'step' => fake()->numberBetween(100, 1000),
            'to' => fake()->date(),
        ];
    }
}
