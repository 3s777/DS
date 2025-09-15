<?php

namespace Tests\RequestFactories\Admin\Shelf;

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
