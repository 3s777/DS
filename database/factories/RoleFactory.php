<?php

namespace Database\Factories;

use Domain\Auth\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Auth\Models\User>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'display_name' => $this->translations(['en', 'ru'], [fake()->name(), fake()->name()]),
            'description' => fake()->text(200),
        ];
    }
}
