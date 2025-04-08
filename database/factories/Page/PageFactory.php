<?php

namespace Database\Factories\Page;

use Domain\Page\Models\Page;
use Domain\Settings\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->translations(['en', 'ru'], [fake()->name(), fake()->name()]),
            'description' => $this->translations(['en', 'ru'], [fake()->sentence(), fake()->sentence()])
        ];
    }
}
