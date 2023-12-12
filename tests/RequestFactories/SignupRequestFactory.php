<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class SignupRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'name' => $this->faker->firstName(),
           'passord' => $this->faker->password(8)
        ];
    }
}
