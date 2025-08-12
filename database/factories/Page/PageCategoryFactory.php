<?php

namespace Database\Factories\Page;

use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Page\Models\PageCategory;
use Domain\Auth\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Page\Models\PageCategory>
 */
class PageCategoryFactory extends Factory
{
    protected $model = PageCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->translations(['en', 'ru'], [fake()->name(), fake()->name()]),
            'description' => $this->translations(['en', 'ru'], [fake()->text(), fake()->text()]),
            'user_id' => User::factory(),
        ];
    }
}
