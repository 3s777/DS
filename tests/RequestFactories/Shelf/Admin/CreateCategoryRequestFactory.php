<?php

namespace Tests\RequestFactories\Shelf\Admin;

use Worksome\RequestFactories\RequestFactory;

class CreateCategoryRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'model' => fake()->name(),
            'description' => fake()->sentence()
        ];
    }
}
