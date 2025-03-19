<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\LoginAdminDTO;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginAdminAction
{
    public function __invoke(LoginAdminDTO $loginData): array
    {
        $user = User::where('email', $loginData->email)->select('email_verified_at')->first();

        $actionResponse = ['user' => $user];

        if ($user && !$user->email_verified_at) {
            $actionResponse['not_verified'] = true;

            return $actionResponse;
        }

        if (Auth::attempt([
            'email' => $loginData->email,
            'password' => $loginData->password,
        ], $loginData->remember)) {
            return $actionResponse;
        }

        $actionResponse['error'] = 'auth.error.credentials';

        return $actionResponse;
    }
}
