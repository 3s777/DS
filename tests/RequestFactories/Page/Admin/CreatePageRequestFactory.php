<?php

namespace Tests\RequestFactories\Page\Admin;

use Worksome\RequestFactories\RequestFactory;

class CreatePageRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence()
        ];
    }
}
