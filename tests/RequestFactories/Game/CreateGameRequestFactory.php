<?php

namespace Tests\RequestFactories\Game;

use App\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateGameRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'type' => Arr::random(GamePlatformTypeEnum::cases())->value,
            'developers' => GameDeveloper::factory(),
        ];
    }
}
