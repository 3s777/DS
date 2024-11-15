<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Seeder;

class CollectibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $shelves = Shelf::factory()->create();

        Collectible::factory(2)
            ->recycle(User::factory(3)->create())
            ->create();
    }
}
