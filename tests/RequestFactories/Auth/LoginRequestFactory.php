<?php

namespace Tests\RequestFactories\Auth;

use Worksome\RequestFactories\RequestFactory;

class LoginRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'password' => '123456789q',
           'remember' => 1,
           'email_verified_at' => now()
        ];
    }
}
