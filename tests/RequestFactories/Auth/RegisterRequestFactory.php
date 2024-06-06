<?php

namespace Tests\RequestFactories\Auth;

use App\Models\Language;
use Worksome\RequestFactories\RequestFactory;

class RegisterRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => $this->faker->regexify('[a-z0-9.]{7}'),
           'password' => '123456789q',
           'password_confirmation' => '123456789q',
           'language_id' => Language::factory()
        ];
    }
}
