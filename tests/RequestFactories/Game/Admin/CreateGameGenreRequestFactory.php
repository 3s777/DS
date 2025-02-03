<?php

namespace Tests\RequestFactories\Game\Admin;

use Worksome\RequestFactories\RequestFactory;

class CreateGameGenreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
