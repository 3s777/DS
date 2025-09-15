<?php

namespace Tests\RequestFactories\Admin\Page;

use Worksome\RequestFactories\RequestFactory;

class CreatePageCategoryRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence()
        ];
    }
}
