<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMediaVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GameMedia>
 */
class GameMediaVariationFactory extends Factory
{
    protected $model = GameMediaVariation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),
            'article_number' => fake()->numberBetween(10000, 100000),
            'barcodes' => [fake()->numberBetween(1000000, 9000000)],
            'alternative_names' => [fake()->name()],
            'user_id' => User::factory(),
            'is_main' => false,
            'region' => array_rand(['pal', 'ntsc'])
        ];
    }
}
