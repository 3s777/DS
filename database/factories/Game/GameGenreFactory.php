<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GameGenre>
 */
class GameGenreFactory extends Factory
{
    protected $model = GameGenre::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'user_id' => User::factory(),
        ];
    }
}
