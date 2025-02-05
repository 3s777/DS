<?php

namespace Tests\RequestFactories\Auth\Collector;

use Illuminate\Http\UploadedFile;
use Worksome\RequestFactories\RequestFactory;

class CreateCollectorRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => $this->faker->regexify('[a-z0-9.]{7}'),
           'first_name' => $this->faker->name,
           'password' => '123456789q',
           'language' => 'en',
           'roles' => [config('settings.default_collector_role'), 'collector'],
           'permissions' => ['entity.*', 'entity.create', 'entity.edit', 'entity.delete'],
           'description' => $this->faker->text(200),
           'featured_image' => UploadedFile::fake()->image('photo1.jpg'),
           'featured_image_uploaded' => $this->faker->name,
           'is_verified' => 1,
           'slug' => $this->faker->name,
        ];
    }
}
