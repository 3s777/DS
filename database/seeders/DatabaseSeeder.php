<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
//            UserSeeder::class,
            CountrySeeder::class,
            RolesAndPermissionsSeeder::class,
            CategoryDataSeeder::class,
            TestUserDataSeeder::class,
//            GameMediaSeeder::class,
            ShelfSeeder::class,
            SaleSeeder::class,
            AuctionSeeder::class,
            PageCategorySeeder::class,
        ]);
    }
}
