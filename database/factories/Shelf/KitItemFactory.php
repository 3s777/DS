<?php

namespace Database\Factories\Shelf;

use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Shelf\Models\KitItem>
 */
class KitItemFactory extends Factory
{
    protected $model = KitItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->translations(['en', 'ru'], [fake()->name(), fake()->name()])
        ];
    }
}
