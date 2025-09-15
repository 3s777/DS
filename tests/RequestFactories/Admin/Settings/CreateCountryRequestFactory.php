<?php

namespace Tests\RequestFactories\Admin\Settings;

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
