<?php

namespace Database\Factories\Page;

use Domain\Auth\Models\User;
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
            'description' => $this->translations(['en', 'ru'], [$this->makeArticle(rand(1,5)), $this->makeArticle(rand(1,5))]),
            'user_id' => User::factory(),
        ];
    }

    private function makeArticle(int $count)
    {
        $article = '';

        for($i = 1; $i <= $count; $i++) {
            $article .= $article.'<p>'.fake()->paragraph(rand(3, 5)).'</p>';
        }

        return $article;
    }
}
