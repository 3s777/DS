<?php

namespace Tests\RequestFactories\Admin\Page;

use Domain\Page\Models\PageCategory;
use Worksome\RequestFactories\RequestFactory;

class CreatePageRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'categories' => [PageCategory::factory(), PageCategory::factory()],
        ];
    }
}
