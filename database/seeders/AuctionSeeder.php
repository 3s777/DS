<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectibles = Collectible::where('target', 'auction')->get();

        if($collectibles) {
            foreach ($collectibles as $collectible) {
                $auction = Auction::factory()
                    ->for($collectible)
                    ->create();

                $collectible->save();
            }
        }
    }
}
