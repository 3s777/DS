<?php

namespace Tests\RequestFactories\App\Auth;

use Worksome\RequestFactories\RequestFactory;

class LoginCollectorRequestFactory extends RequestFactory
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
