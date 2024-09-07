<?php

namespace Tests\RequestFactories\Auth\Role;

use Worksome\RequestFactories\RequestFactory;

class CreateRoleRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'display_name' => fake()->name(),
            'description' => fake()->text(),
            'permissions' => ['entity.*', 'entity.create', 'entity.edit', 'entity.delete']
        ];
    }
}
