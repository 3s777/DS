<?php

namespace Database\Factories\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GamePlatformManufacturer>
 */
class GamePlatformManufacturerFactory extends Factory
{
    protected $model = GamePlatformManufacturer::class;
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
            'user_id' => User::factory(),
        ];
    }
}
