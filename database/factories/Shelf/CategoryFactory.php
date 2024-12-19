<?php

namespace Database\Factories\Shelf;

use Domain\Shelf\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Shelf\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->translations(['en', 'ru'], [fake()->name(), fake()->name()]),
            'model' => fake()->unique()->name(),
            'description' => $this->translations(['en', 'ru'], [fake()->sentence(), fake()->sentence()])
        ];
    }
}
