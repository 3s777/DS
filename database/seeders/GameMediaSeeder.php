<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Seeder;

class GameMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameMedia::factory(10)
            ->has(
                Game::factory(1)
                    ->has(GameDeveloper::factory(2), 'developers')
                    ->has(GamePublisher::factory(2), 'publishers')
                    ->has(GameGenre::factory(3), 'genres')
                    ->has(GamePlatform::factory(2), 'platforms'),
                'games'
            )
            ->has(GameDeveloper::factory(2), 'developers')
            ->has(GamePublisher::factory(2), 'publishers')
            ->has(GameGenre::factory(3), 'genres')
            ->has(GamePlatform::factory(2), 'platforms')
            ->has(KitItem::factory(2), 'kitItems')
            ->recycle(User::factory(5)->create())
            ->create();
    }
}
