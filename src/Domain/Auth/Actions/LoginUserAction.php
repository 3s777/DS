<?php

namespace Domain\Auth\Actions;

use App\Http\Requests\Auth\LoginRequest;
use Domain\Auth\DTOs\LoginUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function __invoke(LoginRequest $request): array
    {
        $loginData = LoginUserDTO::fromRequest($request);

        $user = User::where('email', $loginData->email)->select('email_verified_at')->first();

        $actionResponse = ['user' => $user];

        if($user && !$user->email_verified_at) {
            $actionResponse['route'] = 'verification.notice';

            return $actionResponse;
        }

        if (Auth::attempt([
            'email' => $loginData->email,
            'password' => $loginData->password,
        ], $loginData->remember))
        {
            $request->session()->regenerate();
            $actionResponse['route'] = 'search';

            return $actionResponse;
        }

        $actionResponse['error'] = 'auth.error.credentials';

        return $actionResponse;
    }
}
