<?php

namespace App\Guards;

use Domain\Auth\JWT;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

final class JWTGuard implements Guard
{
    use GuardHelpers;

    public const BLACKLIST_KEY = 'blacklist_token_';
    //    public bool $blackListChecked = false;

    public function __construct(
        private JWT $jwt,
        UserProvider $provider
    ) {
        $this->provider = $provider;
    }

    public function user()
    {
        $token = request()?->bearerToken();

        if ($token === null) {
            return null;
        }

        //        if (!$this->blackListChecked && cache()->has(self::BLACKLIST_KEY . $token)) {
        //            return null;
        //        }
        //
        //        $this->blackListChecked = true;

        if ($this->user !== null) {
            return $this->user;
        }


        $id = $this->jwt->parse($token);

        return $this->user = $this->provider->retrieveById($id);
    }

    public function logout(): void
    {
        $token = request()?->bearerToken();

        cache()->put(self::BLACKLIST_KEY . $token, $token, $this->jwt->getExpiresAt());

        //        $this->blackListChecked = false;

        $this->user = null;
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

    //    /**
    //     * Determine if the current user is authenticated.
    //     *
    //     * @return bool
    //     */
    //    public function check()
    //    {
    //        dd($this->user());
    //        return ! is_null($this->user());
    //    }
    //
    //    /**
    //     * Determine if the current user is a guest.
    //     *
    //     * @return bool
    //     */
    //    public function guest()
    //    {
    //        return ! $this->check();
    //    }
}
