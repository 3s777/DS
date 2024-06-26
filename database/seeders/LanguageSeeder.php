<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'Русский',
            'slug' => 'ru'
        ]);

        Language::create([
            'name' => 'Английский',
            'slug' => 'en'
        ]);

        Language::create([
            'name' => 'Украинский',
            'slug' => 'ua'
        ]);
    }
}
