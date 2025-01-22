<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\Models\Auction;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        // TODO::Возможно стоит полностью переделать сиды.
        // Вызвать сначала все фабрики, собрать их в коллекции и дальше привязать друг к другу вручную
        // Так можно избежать создания лишних моделей
        //        $this->call([
        //            UserSeeder::class
        //        ]);

        $users = User::factory(5)->create();

        foreach ($users as $user) {
            $collectableFactory = fake()->randomElement([
                GameMedia::factory(5)
                    ->has(
                        Game::factory(1)
                            ->has(GameDeveloper::factory(2)->for($user, 'user'), 'developers')
                            ->has(GamePublisher::factory(2)->for($user, 'user'), 'publishers')
                            ->has(GameGenre::factory(3)->for($user, 'user'), 'genres')
                            ->has(GamePlatform::factory(2)
                                ->for(GamePlatformManufacturer::factory()->for($user, 'user'), 'game_platform_manufacturer')
                                ->for($user, 'user'), 'platforms')
                            ->for($user, 'user'),
                        'games'
                    )
                    ->has(GameDeveloper::factory(2)->for($user, 'user'), 'developers')
                    ->has(GamePublisher::factory(2)->for($user, 'user'), 'publishers')
                    ->has(GameGenre::factory(3)->for($user, 'user'), 'genres')
                    ->has(GamePlatform::factory(2)
                        ->for(GamePlatformManufacturer::factory()->for($user, 'user'), 'game_platform_manufacturer')
                        ->for($user, 'user'), 'platforms')
//                    ->for($user, 'user')
            ]);

            $collectableFactory
                ->has(KitItem::factory(rand(1,3)), 'kitItems')
                ->has(Collectible::factory()
                    ->for(Shelf::factory()->for($user, 'user'), 'shelf')
                    ->for($user, 'user')
                    ->hasKitConditions(),
                    'collectibles')
                ->for($user, 'user')
                ->create();
        }


//        $collectibles = [];
//        foreach($gameMedias as $media) {
//            $collectibles[] = Collectible::factory(5)
//                ->for($users->random())
//                ->tests($media)
//                ->hasKitConditions();
//        }
//
//        $collectionCollectibles = collect($collectibles);

//            Shelf::factory(2)
//                ->has($collectionCollectibles->random()),
////                    ->state(['kit_conditions' => 'test']),
//                    'collectibles')
//                ->for($user, 'user')
//                ->create();
//        }
    }
}
