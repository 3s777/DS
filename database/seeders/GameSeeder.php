<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(GamesDbApiContract $gamesApi): void
    {
        Game::factory(10)
            ->has(GameDeveloper::factory(2), 'developers')
            ->has(GamePublisher::factory(2), 'publishers')
            ->has(GameGenre::factory(3), 'genres')
            ->has(GamePlatform::factory(2), 'platforms')
            ->recycle(User::factory(5)->create())
            ->create();
    }
}
