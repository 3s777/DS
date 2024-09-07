<?php

namespace Database\Factories\Game;

use App\Enums\GamePlatformTypeEnum;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GamePlatform>
 */
class GamePlatformFactory extends Factory
{
    protected $model = GamePlatform::class;
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
            'type' => Arr::random(GamePlatformTypeEnum::cases()),
            'game_platform_manufacturer_id' => GamePlatformManufacturer::factory(),
        ];
    }
}
