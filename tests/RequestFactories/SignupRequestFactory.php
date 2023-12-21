<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class SignupRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => 'qqqqq',
           'password' => '123456789q',
           'password_confirmation' => '123456789q'
        ];
    }
}
