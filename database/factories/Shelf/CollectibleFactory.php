<?php

namespace Database\Factories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Contracts\Collectable;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
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

    private function getCollectableModel(string $type, int $id): Collectable
    {
        $modelClass = Relation::getMorphedModel($type);
        return $modelClass::find($id);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $target = Arr::random(TargetEnum::cases());
        //        $sale = [];
        //        $auction = [];

        //        if($target->value == 'sale') {
        //            $sale = ['price' => rand(100, 20000)];
        //        }
        //
        //        if($target->value == 'auction') {
        //            $auction = [
        //                'price' => rand(100, 20000),
        //                'step' => rand(10, 100),
        //                'to' =>  now()->addDays(rand(1, 5))->format('d-m-Y')
        //            ];
        //        }



        return [
            'name' => fake()->name(),
            'ulid' => Str::ulid(),
            'article_number' => fake()->word(),
            'condition' => Arr::random(ConditionEnum::cases())->value,
//            'user_id' => User::factory(),

            'category_id' => function (array $attributes) {
                return Category::where('model', $attributes['collectable_type'])->first();
            },
            'shelf_id' => Shelf::factory(),
            'collector_id' => function (array $attributes) {
                $shelf = Shelf::find($attributes['shelf_id']);
                return $shelf->collector_id;
            },
            'kit_score' => rand(1, 10),
//            'collectable_type' => fake()->randomElement([
//                'game_media'
//            ]),
//            'collectable_id' => function(array $attributes) {
//                $className = Relation::getMorphedModel($attributes['collectable_type']);
//                return $className::factory()->has(KitItem::factory(rand(1,3)));
//            },
            'mediable_type' => function(array $attributes) {
                $collectable = $this->getCollectableModel(
                    $attributes['collectable_type'],
                    $attributes['collectable_id']
                );
                return $collectable->getMediableType();
            },
            'mediable_id' => function(array $attributes) {

                $collectable = $this->getCollectableModel(
                    $attributes['collectable_type'],
                    $attributes['collectable_id']
                );

                return $collectable->getMediableId();
            },
            'seller' => fake()->name(),
            'purchase_price' => fake()->numberBetween(1000, 100000),
            'purchased_at' => fake()->date(),
            'additional_field' => fake()->name(),
            'target' => $target->value,
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()])
        ];
    }

    public function hasKitConditions(): static
    {
        return $this->state(
            fn (array $attributes) =>
            [
                'kit_conditions' => function (array $attributes) {
                    $className = Relation::getMorphedModel($attributes['collectable_type']);
                    $collectable = $className::find($attributes['collectable_id']);
                    $kitConditions = [];

                    foreach ($collectable->kitItems as $kitItem) {
                        $kitConditions[$kitItem->id] = rand(1, 10);
                    }

                    return $kitConditions;
                }
            ]
        )->afterCreating(function (Collectible $collectible) {
            foreach ($collectible->kit_conditions as $id => $condition) {
                $collectible->kitItems()->attach($id, ['condition' => $condition]);
            }
        });
    }

    public function forSale(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'target' => 'sale',
            ];
        });
    }

    public function forAuction(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'target' => 'auction',
            ];
        });
    }
}
