<?php

namespace Tests\RequestFactories\Settings\Admin;

use Worksome\RequestFactories\RequestFactory;

class CreateCountryRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name()
        ];
    }
}
