<?php

namespace Database\Factories;

use Domain\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Auth\Models\User>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;
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
