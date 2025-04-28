<?php

namespace App\Guards;

use Domain\Auth\JWT;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

final class JWTGuard implements Guard
{
    use GuardHelpers;

    public function __construct(
        private JWT $jwt,
        UserProvider $provider,
        private Request $request
    )
    {
        $this->provider = $provider;
    }

    public function user()
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $token = $this->request->bearerToken();

        if ($token === null) {
            return null;
        }

        $id = $this->jwt->parse($token);

        return $this->user = $this->provider->retrieveById($id);
    }

    public function retrieveIdByCredentials(string $email, string $password): ?string
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        $user = $this->validate($credentials);

        if ($user === null) {
           return null;
        }

        if (!$this->provider->validateCredentials($user, $credentials)) {
           return null;
        }

        return (string) $user->getAuthIdentifier();
    }

    public function validate(array $credentials = [])
    {
        return $this->provider->retrieveByCredentials($credentials);
    }
}
