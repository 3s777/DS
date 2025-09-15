<?php

namespace Tests\RequestFactories\Admin\Game;

use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\KitItem;
use Worksome\RequestFactories\RequestFactory;

class CreateGameMediaVariationRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'article_number' => fake()->word(),
            'description' => fake()->text(),
            'kit_items' => [KitItem::factory(2)],
            'alternative_names' => fake()->name().'||'.fake()->name(),
            'barcodes' => fake()->name().'||'.fake()->name(),
            'is_main' => fake()->boolean(),
            'game_media_id' => GameMedia::factory()
        ];
    }
}
