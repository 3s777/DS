<?php

namespace Tests\RequestFactories\Shelf;

use Worksome\RequestFactories\RequestFactory;

class CreateCategoryRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence()
        ];
    }
}
