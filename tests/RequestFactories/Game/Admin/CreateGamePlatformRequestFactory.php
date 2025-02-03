<?php

namespace Tests\RequestFactories\Game\Admin;

use Domain\Game\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatformManufacturer;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateGamePlatformRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'type' => Arr::random(GamePlatformTypeEnum::cases())->value,
            'game_platform_manufacturer_id' => GamePlatformManufacturer::factory(),
        ];
    }
}
