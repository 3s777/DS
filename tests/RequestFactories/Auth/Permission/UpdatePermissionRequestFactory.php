<?php

namespace Tests\RequestFactories\Auth\Permission;

use Worksome\RequestFactories\RequestFactory;

class UpdatePermissionRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'display_name' => fake()->name(),
            'description' => fake()->text(),
            'guard_name' => fake()->randomElement(['admin', 'collector'])
        ];
    }
}
