<?php

namespace Database\Seeders;

use Domain\Shelf\Models\Collectible;
use Domain\Trade\Models\Auction;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectibles = Collectible::where('target', 'auction')->get();

        if ($collectibles) {
            foreach ($collectibles as $collectible) {
                $auction = Auction::factory()
                    ->for($collectible)
                    ->create();

                $collectible->save();
            }
        }
    }
}
