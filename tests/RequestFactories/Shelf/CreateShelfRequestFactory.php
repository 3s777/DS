<?php

namespace Tests\RequestFactories\Shelf;

use Worksome\RequestFactories\RequestFactory;

class CreateShelfRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'number' => rand(1, 100),
            'description' => fake()->text()
        ];
    }
}
