<?php

namespace Database\Factories\Trade;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Trade\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(100, 1000000),
            'old_price' => fake()->numberBetween(100, 1000000),
            'quantity' => fake()->numberBetween(1, 100)
        ];
    }
}
