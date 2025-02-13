<?php

namespace Database\Factories\Shelf;

use Domain\Auth\Models\Collector;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Shelf\Models\Shelf>
 */
class ShelfFactory extends Factory
{
    protected $model = Shelf::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'number' => rand(0, 100),
            'ulid' => Str::ulid(),
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),
            'collector_id' => Collector::factory(),
        ];
    }
}
