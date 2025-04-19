<?php

namespace Database\Seeders;

use Domain\Page\Models\Page;
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
            ->has(Page::factory()->count(2))
            ->create();

        PageCategory::factory()
            ->has(Page::factory()->count(10))
            ->create([
                'slug' => 'qa',
                'name' => 'QA'
            ]);

        PageCategory::factory()
            ->has(Page::factory()->count(5))
            ->create([
                'slug' => 'rules',
                'name' => 'Rules'
            ]);
    }
}
