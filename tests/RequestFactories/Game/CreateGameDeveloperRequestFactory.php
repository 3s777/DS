<?php

namespace Tests\RequestFactories\Game;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Worksome\RequestFactories\RequestFactory;

class CreateGameDeveloperRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
//            'featured_image' => UploadedFile::fake()->image(Storage::disk('images')->path('test/test.jpg'), 640, 480, null, false)
        ];
    }
}
