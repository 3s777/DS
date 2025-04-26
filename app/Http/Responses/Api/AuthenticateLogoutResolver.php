<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use App\Contracts\Api\ResponseResolverContract;


class AuthenticateLogoutResolver implements ResponseResolverContract
{
    public function with(mixed $data = null): static
    {
        return $this;
    }

    public function resolve(): mixed
    {
        return null;
    }
}
