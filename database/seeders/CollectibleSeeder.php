<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;

class CollectibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $shelves = Shelf::factory()->create();

        Collectible::factory(2)
//            ->has(GameDeveloper::factory(2), 'developers')
//            ->has(GamePublisher::factory(2), 'publishers')
//            ->has(GameGenre::factory(3), 'genres')
//            ->for($shelves, 'shelf')
//            ->for(User::factory()->recycle($shelves)->create(), 'user')
            ->recycle(User::factory(3)->create())
            ->create();
    }
}
