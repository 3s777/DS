<?php

namespace Tests\RequestFactories\Game;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Worksome\RequestFactories\RequestFactory;

class CreateGameGenreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
