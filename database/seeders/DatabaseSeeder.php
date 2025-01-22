<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Trade\Models\Auction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
//            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            CategoryDataSeeder::class,
            TestUserDataSeeder::class,
//            GameMediaSeeder::class,
            ShelfSeeder::class,
            SaleSeeder::class,
            AuctionSeeder::class
        ]);
    }
}
