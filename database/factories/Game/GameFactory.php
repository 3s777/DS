<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\Game>
 */
class GameFactory extends Factory
{
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
            'released_at' => fake()->date(),
            'user_id' => User::factory(),
        ];
    }
}
