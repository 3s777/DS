<?php

namespace Tests\RequestFactories\Admin\Shelf;

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
