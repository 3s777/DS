<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();
//        $gameMedias = GameMedia::factory(5)->has(KitItem::factory(5), 'kitItems')->create();

            $collectable = Collectible::factory(5)
                ->for($users->random())
                    ->for(
                        fake()->randomElement([
                            GameMedia::factory()
                        ])
                            ->has(KitItem::factory(rand(1,3)), 'kitItems'),
                    'collectable')
//                ->for(new Sequence(
//                    fn (Sequence $sequence) => $gameMedias->random()
//                ), 'collectable')
//                        ->recycle($gameMedias->random())
                ->hasKitConditions()->create();
//                ->state(['kit_conditions' => 'test']);


        foreach($users as $user) {


//            $collectable = Collectible::factory(5)
//                ->for($user, 'user')
//                    ->for(
//                        fake()->randomElement([
//                            GameMedia::factory()
//                        ])
//                            ->has(KitItem::factory(rand(1,3)), 'kitItems'),
//                    'collectable')
////                ->for(new Sequence(
////                    fn (Sequence $sequence) => $gameMedias->random()
////                ), 'collectable')
////                        ->recycle($gameMedias->random())
//                ->hasKitConditions();
////                ->state(['kit_conditions' => 'test']);
//
//
//
//
//
//            Shelf::factory(2)
//                ->has($collectable,
////                    ->state(['kit_conditions' => 'test']),
//                    'collectibles')
//                ->for($user, 'user')
//                ->create();
        }
    }
}
