<?php

namespace Tests\RequestFactories\Trade;

use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateSaleRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $gameMedia = GameMedia::factory()->has(KitItem::factory(rand(1, 3)), 'kitItems')->create();
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
            'price_old' => rand(200, 30000),
            'quantity' => fake()->numberBetween(1, 100),
            'reservation' => Arr::random(ReservationEnum::cases())->value,
            'bidding' => fake()->boolean,
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
