<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GameDeveloper>
 */
class GameDeveloperFactory extends Factory
{
    protected $model = GameDeveloper::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'user_id' => User::query()->inRandomOrder()->first()->id
        ];
    }
}
