<?php

namespace Database\Factories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Shelf\Models\Collectible>
 */
class CollectibleFactory extends Factory
{
    protected $model = Collectible::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'ulid' => Str::ulid(),
            'article_number' => fake()->title(),
            'condition' => fake()->title(),
            'shelf_id' => Shelf::factory(),
            'collectable_type' => fake()->randomElement([
                GameMedia::class
            ]),
            'collectable_id' => function(array $attributes) {
                return $attributes['collectable_type']::factory();
            },
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),
            'user_id' => User::factory(),
        ];
    }
}
