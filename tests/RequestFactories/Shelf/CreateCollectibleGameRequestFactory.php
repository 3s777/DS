<?php

namespace Tests\RequestFactories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateCollectibleGameRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $gameMedia = GameMedia::factory()->has(KitItem::factory(rand(1,3)), 'kitItems')->create();

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
                'to' =>  now()->addDays(rand(1, 5))->format('Y-m-d')
            ];
        }

        return [
            'name' => fake()->name(),
            'shelf_id' => Shelf::factory(),
            'article_number' => fake()->uuid(),
            'condition' => Arr::random(ConditionEnum::cases())->value,
            'purchase_price' => fake()->numberBetween(1000, 100000),
            'seller' => fake()->name(),
            'purchased_at' => fake()->date(),
            'description' => fake()->text(),
            'additional_field' => fake()->title(),
            'properties' => [
                'is_done' => fake()->boolean(),
                'is_digital' => true
            ],
            'collectable' => $gameMedia->id,
            'collectable_type' => CollectibleTypeEnum::Game->morphName(),
            'target' => $target->value,
            'sale' => $sale,
            'auction' => $auction
        ];
    }

    public function hasKitConditions(): static
    {
        return $this->state(
        [
            'kit_conditions' => function(array $properties) {
                $className = Relation::getMorphedModel(CollectibleTypeEnum::Game->morphName());
                $collectable = $className::find($properties['collectable']);
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
