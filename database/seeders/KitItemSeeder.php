<?php

namespace Database\Seeders;

use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Seeder;

class KitItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KitItem::factory(10)->create();
    }
}
