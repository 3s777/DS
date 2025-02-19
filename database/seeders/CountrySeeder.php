<?php

namespace Database\Seeders;

use Domain\Settings\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => [
                    'ru' => 'Россия',
                    'en' => 'Russia'
                ],
            ],
            [
                'name' => [
                    'ru' => 'Украина',
                    'en' => 'Ukraine'
                ],
            ],
            [
                'name' => [
                    'ru' => 'Беларусь',
                    'en' => 'Belarus'
                ],
            ],
            [
                'name' => [
                    'ru' => 'Казахстан',
                    'en' => 'Kazakhstan'
                ],
            ]
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
