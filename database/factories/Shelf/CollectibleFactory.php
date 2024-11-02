<?php

namespace Database\Factories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
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
        $target = Arr::random(TargetEnum::cases());
        $sale = [];
        $auction = [];

        if($target->value == 'sale') {
            $sale = ['price' => rand(100, 20000)];
        }

        if($target->value == 'auction') {
            $auction = [
                'price' => rand(100, 20000),
                'step' => rand(10, 100),
                'to' =>  now()->addDays(rand(1, 5))->format('d-m-Y')
            ];
        }



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
            'purchase_price' => $this->faker->numberBetween(1000, 100000),
            'target' => $target,
            'sale' => $sale,
            'auction' => $auction,
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),
            'user_id' => User::factory(),
        ];
    }
}
