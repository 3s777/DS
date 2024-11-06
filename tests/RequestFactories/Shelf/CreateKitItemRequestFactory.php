<?php

namespace Tests\RequestFactories\Shelf;

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
