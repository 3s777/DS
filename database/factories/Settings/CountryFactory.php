<?php

namespace Database\Factories\Settings;

use Domain\Settings\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Setting\Models\Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->translations(['en', 'ru'], [fake()->country(), fake()->country()])
        ];
    }
}
