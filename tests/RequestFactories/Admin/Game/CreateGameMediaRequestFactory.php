<?php

namespace Tests\RequestFactories\Admin\Game;

use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Models\KitItem;
use Worksome\RequestFactories\RequestFactory;

class CreateGameMediaRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'released_at' => fake()->date(),
            'games' => [Game::factory(), Game::factory()],
            'developers' => [GameDeveloper::factory(), GameDeveloper::factory()],
            'publishers' => [GamePublisher::factory()],
            'genres' => [GameGenre::factory(), GameGenre::factory()],
            'platforms' => [GamePlatform::factory()],
            'kit_items' => [KitItem::factory(2)],
            'alternative_names' => fake()->name().'||'.fake()->name(),
            'barcodes' => fake()->name().'||'.fake()->name(),
        ];
    }
}
