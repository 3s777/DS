<?php

namespace Tests\RequestFactories\App\Trade;

use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateAuctionRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $gameMediaVariation = GameMediaVariation::factory()
            ->has(KitItem::factory(rand(1, 3)), 'kitItems')
            ->for(GameMedia::factory(), 'gameMedia')
            ->create();
        $countries = Country::factory(3)->create();
        $category = Category::factory(['model' => 'game_media'])->create();
        $collectible = Collectible::factory(
            [
                'collectable_type' => 'game_media',
                'collectable_id' => $gameMediaVariation->id,
                'mediable_id' => $gameMediaVariation->game_media_id,
                'mediable_type' => 'game_media',
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

        if ($collectibleData['shipping'] == ShippingEnum::Selected->value) {
            $collectibleData['shipping_countries'] = $countries->pluck('id')->toArray();
        }

        return $collectibleData;
    }
}
