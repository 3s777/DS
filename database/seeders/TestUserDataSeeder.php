<?php

namespace Database\Seeders;

use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Seeder;

class TestUserDataSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'qqqqq',
            'first_name' => 'Test Name',
            'slug' => 'qqqqq',
            'email' => 'qqq@qq.qq',
            'password' => bcrypt('123456789q'),
            'email_verified_at' => now(),
            'language' => 'en'
        ]);

        $testUser = User::where('name', 'qqqqq')->first();

        $testUser->assignRole('super_admin');

        $testCollector = Collector::create([
            'name' => 'qqqqq.collector',
            'first_name' => 'Test Name',
            'slug' => 'qqqqq',
            'email' => 'qqq@qq.qq',
            'password' => bcrypt('123456789q'),
            'email_verified_at' => now(),
            'language' => 'en'
        ]);

        $testCollector->assignRole('collector');

        $collectableFactory = fake()->randomElement([
            GameMediaVariation::factory(3)->for(
                GameMedia::factory()
                    ->has(
                        Game::factory(1)
                            ->has(GameDeveloper::factory(2)->for($testUser, 'user'), 'developers')
                            ->has(GamePublisher::factory(2)->for($testUser, 'user'), 'publishers')
                            ->has(GameGenre::factory(3)->for($testUser, 'user'), 'genres')
                            ->has(GamePlatform::factory(2)
                                ->for(GamePlatformManufacturer::factory()->for($testUser, 'user'), 'game_platform_manufacturer')
                                ->for($testUser, 'user'), 'platforms')
                            ->for($testUser, 'user'),
                        'games'
                    )
                    ->has(GameDeveloper::factory(2)->for($testUser, 'user'), 'developers')
                    ->has(GamePublisher::factory(2)->for($testUser, 'user'), 'publishers')
                    ->has(GameGenre::factory(3)->for($testUser, 'user'), 'genres')
                    ->has(GamePlatform::factory(2)
                        ->for(GamePlatformManufacturer::factory()->for($testUser, 'user'), 'game_platform_manufacturer')
                        ->for($testUser, 'user'), 'platforms')
                    ->for($testUser, 'user'),
                'gameMedia'
            )->for($testUser, 'user')
        ]);

        $collectableFactory
            ->has(KitItem::factory(rand(1, 3))->for($testUser, 'user'), 'kitItems')
            ->has(
                Collectible::factory()
                ->for(Shelf::factory()->for($testCollector, 'collector'), 'shelf')
                ->for($testUser, 'user')
                ->hasKitConditions(),
                'collectibles'
            )
            ->for(User::factory(), 'user')
            ->create();
    }
}
