<?php

namespace Tests\RequestFactories\Admin\Auth;

use Worksome\RequestFactories\RequestFactory;

class CreateRoleRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'display_name' => fake()->name(),
            'description' => fake()->text(),
//            'permissions_admin' => ['entity.*', 'entity.create', 'entity.edit', 'entity.delete'],
            'guard_name' => fake()->randomElement(['admin', 'collector'])
        ];
    }
}
