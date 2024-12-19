<?php

namespace Database\Seeders;

use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class CategoryDataSeeder extends Seeder
{
    public function run(): void
    {
        Category::create(
            [
                'name' => 'Игра',
                'model' => Relation::getMorphAlias(GameMedia::class)
            ],
        );

        Category::create(
            [
                'name' => 'Книга',
                'model' => 'test'
            ],
        );
    }
}
