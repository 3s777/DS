<?php

namespace Database\Factories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
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
            'condition' => Arr::random(ConditionEnum::cases())->value,
            'user_id' => User::factory(),
            'shelf_id' => Shelf::factory(),
//            'collectable_type' => fake()->randomElement([
//                'game_media'
//            ]),
//            'collectable_id' => function(array $attributes) {
//                $className = Relation::getMorphedModel($attributes['collectable_type']);
//                return $className::factory()->has(KitItem::factory(rand(1,3)));
//            },
            'seller' => fake()->name(),
            'purchase_price' => fake()->numberBetween(1000, 100000),
            'purchased_at' => fake()->date(),
            'additional_field' => fake()->title(),
            'target' => $target,
            'sale' => $sale,
            'auction' => $auction,
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()])
        ];
    }

    public function hasKitConditions(): static
    {
        return $this->state(fn (array $attributes) =>
            [
                'kit_conditions' => function(array $attributes) {
                    $className = Relation::getMorphedModel($attributes['collectable_type']);
                    $collectable = $className::find($attributes['collectable_id']);
                    $kitConditions = [];

                    foreach($collectable->kitItems as $kitItem)  {
                        $kitConditions[$kitItem->id] = rand(1,10);
                    }

                    return $kitConditions;
                }
            ]
        );
    }
}
