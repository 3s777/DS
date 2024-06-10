<?php

namespace Tests\RequestFactories\Auth\User;

use App\Models\Language;
use Illuminate\Http\UploadedFile;
use Worksome\RequestFactories\RequestFactory;

class CreateUserRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => $this->faker->regexify('[a-z0-9.]{7}'),
           'password' => '123456789q',
           'password_confirmation' => '123456789q',
           'language_id' => Language::factory(),
           'roles' => [config('settings.default_role'), 'editor'],
           'description' => $this->faker->text(200),
           'thumbnail' => UploadedFile::fake()->image('photo1.jpg'),
           'is_verified' => true,
        ];
    }
}
