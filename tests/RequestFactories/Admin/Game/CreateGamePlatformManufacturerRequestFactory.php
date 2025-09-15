<?php

namespace Tests\RequestFactories\Admin\Game;

use Worksome\RequestFactories\RequestFactory;

class CreateGamePlatformManufacturerRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
