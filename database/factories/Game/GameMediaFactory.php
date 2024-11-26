<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GameMedia>
 */
class GameMediaFactory extends Factory
{
    protected $model = GameMedia::class;

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
            'released_at' => fake()->date(),
            'user_id' => User::factory(),
            'category_id' => 1,
        ];
    }
}
