<?php

namespace Tests\RequestFactories\Shelf\Admin;

use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateCollectibleGameRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $gameMedia = GameMedia::factory()->has(KitItem::factory(rand(1,3)), 'kitItems')->create();
        $countries = Country::factory(3)->create();

//        $target = Arr::random(TargetEnum::cases());
        $target = TargetEnum::Collection;
        $sale = [];
        $auction = [];

        if($target->value == 'sale') {
            $sale = [
                'price' => rand(100, 20000),
                'quantity' => fake()->numberBetween(1, 100),
                'reservation' => Arr::random(ReservationEnum::cases())->value,
                'bidding' => fake()->boolean
            ];
        }

        if($target->value == 'auction') {
            $auction = [
                'price' => rand(100, 20000),
                'step' => rand(10, 100),
                'finished_at' =>  now()->addDays(rand(1, 5))->format('Y-m-d H:m'),
                'blitz' => fake()->numberBetween(1, 10000),
                'renewal' => fake()->numberBetween(1, 10),
            ];
        }

        $collectibleData = [
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

        if($target->value == 'auction' || $target->value == 'sale') {
            $collectibleData['shipping'] = Arr::random(ShippingEnum::cases())->value;
            $collectibleData['country_id'] = $countries->first()->id;
            $collectibleData['self_delivery'] = fake()->boolean;

            if($collectibleData['shipping'] == ShippingEnum::Selected->value) {
                $collectibleData['shipping_countries'] = [$countries];
            }
        }

        return $collectibleData;
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

    public function hasSale()
    {
        $countries = Country::factory(3)->create();

        $sale = [
            'target' => 'sale',
            'sale' => [
                'price' => rand(100, 20000),
                'quantity' => fake()->numberBetween(1, 100),
                'reservation' => Arr::random(ReservationEnum::cases())->value,
                'bidding' => fake()->boolean
            ],
            'shipping' => Arr::random(ShippingEnum::cases())->value,
            'country_id' => $countries->first()->id,
            'self_delivery' => fake()->boolean,
        ];

        if($sale['shipping'] == ShippingEnum::Selected->value) {
            $sale['shipping_countries'] = [$countries];
        }

        return $this->state($sale);
    }
}
