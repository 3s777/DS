<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();

        foreach($users as $user) {
            Shelf::factory(2)
                ->has(Collectible::factory(5)
                    ->for($user, 'user'), 'collectibles')
                ->for($user, 'user')
                ->create();
        }
    }
}
