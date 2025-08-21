<?php

namespace Tests\RequestFactories\Auth\Public;

use Illuminate\Http\UploadedFile;
use Worksome\RequestFactories\RequestFactory;

class UpdateCollectorProfileRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => $this->faker->regexify('[a-z0-9.]{7}'),
           'first_name' => $this->faker->name,
           'password' => '123456789q',
            'language' => 'en',
           'description' => $this->faker->text(200),
           'featured_image' => UploadedFile::fake()->image('photo1.jpg'),
           'featured_image_uploaded' => $this->faker->name,
        ];
    }
}
