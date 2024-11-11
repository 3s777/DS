<?php

namespace Tests\RequestFactories\Shelf;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Arr;
use Worksome\RequestFactories\RequestFactory;

class CreateCollectibleGameRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => [User::factory()],
            'shelf_id' => [Shelf::factory()],
            'article_number' => fake()->uuid(),
            'condition' => Arr::random(ConditionEnum::cases())->value,
            'purchase_price' => fake()->numberBetween(1000, 100000),
            'seller' => fake()->name(),
            'purchased_at' => fake()->date(),
            'description' => fake()->text(),
            'additional_field' => fake()->title(),
            'properties.is_done' => fake()->boolean(),
            'properties.is_digital'  => fake()->boolean(),
            'media' => [GameMedia::factory()],

        ];
    }
}
