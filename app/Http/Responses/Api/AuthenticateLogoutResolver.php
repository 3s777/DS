<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use App\Contracts\Api\ResponseResolverContract;
use Domain\Auth\JWT;
use Illuminate\Contracts\Auth\Factory;


class AuthenticateLogoutResolver implements ResponseResolverContract
{
    public function __construct(
        private Factory $auth
    )
    {
    }

    public function with(mixed $data = null): static
    {
        return $this;
    }

    public function resolve(): bool
    {
        $this->auth->guard('jwt')->logout();

        return true;
    }
}
