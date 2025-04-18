<?php

namespace Database\Seeders;

use Domain\Page\Models\PageCategory;
use Illuminate\Database\Seeder;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageCategory::factory(10)
            ->create();
    }
}
