<?php

namespace Tests\RequestFactories\Shelf\Admin;

use Worksome\RequestFactories\RequestFactory;

class CreateKitItemRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name()
        ];
    }
}
