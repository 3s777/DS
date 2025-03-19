<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\LoginCollectorDTO;
use Domain\Auth\Models\Collector;
use Illuminate\Support\Facades\Auth;

class LoginCollectorAction
{
    public function __invoke(LoginCollectorDTO $loginData): array
    {
        $collector = Collector::where('email', $loginData->email)->select('email_verified_at')->first();

        $actionResponse = ['collector' => $collector];

        if ($collector && !$collector->email_verified_at) {
            $actionResponse['not_verified'] = true;

            return $actionResponse;
        }

        if (Auth::guard('collector')->attempt([
            'email' => $loginData->email,
            'password' => $loginData->password,
        ], $loginData->remember)) {
            return $actionResponse;
        }

        $actionResponse['error'] = 'auth.error.credentials';

        return $actionResponse;
    }
}
