<?php

namespace Database\Seeders;

use Domain\Shelf\Models\Category;
use Illuminate\Database\Seeder;

class CategoryDataSeeder extends Seeder
{
    public function run(): void
    {
        Category::create(
            ['name' => 'Книга']
        );

        Category::create(
            ['name' => 'Игра']
        );
    }
}
