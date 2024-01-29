<?php

namespace Tests\RequestFactories\Auth;

use App\Models\Language;
use Carbon\Carbon;
use Worksome\RequestFactories\RequestFactory;

class LoginRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => $this->faker->email,
           'password' => '123456789q',
           'email_verified_at' => now()
        ];
    }
}
