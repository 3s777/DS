<?php

namespace Tests\RequestFactories\Trade;

use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateAuctionRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $gameMedia = GameMedia::factory()->has(KitItem::factory(rand(1,3)), 'kitItems')->create();
        $countries = Country::factory(3)->create();
        $category = Category::factory(['model' => 'game_media'])->create();
        $collectible = Collectible::factory(
            [
                'collectable_type' => 'game_media',
                'collectable_id' => $gameMedia->id
            ]
        )->create();

        $collectibleData = [
            'collectible_id' => $collectible->id,
            'price' => rand(100, 20000),
            'step' => rand(10, 100),
            'finished_at' =>  now()->addDays(rand(1, 5))->format('Y-m-d H:m'),
            'blitz' => fake()->numberBetween(1, 10000),
            'renewal' => fake()->numberBetween(1, 10),
            'shipping' => Arr::random(ShippingEnum::cases())->value,
            'country_id' => $countries->first()->id,
            'self_delivery' => fake()->boolean,
        ];

        if($collectibleData['shipping'] == ShippingEnum::Selected->value) {
            $collectibleData['shipping_countries'] = $countries->pluck('id')->toArray();
        }

        return $collectibleData;
    }
}
