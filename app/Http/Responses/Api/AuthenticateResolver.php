<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use App\Contracts\Api\ResponseResolverContract;
use App\Dto\AuthenticateDto;
use Domain\Auth\JWT;
use Illuminate\Contracts\Auth\Factory;


class AuthenticateResolver implements ResponseResolverContract
{
    private ?AuthenticateDto $dto = null;

    public function __construct(
        private JWT $jwt,
        private Factory $auth
    )
    {

    }


    public function with(mixed $data = null): static
    {
        $this->dto = $data;

        return $this;
    }

    public function resolve(): ?string
    {
        $id = $this->auth->guard('jwt')->retrieveIdByCredentials(
            $this->dto->getEmail(),
            $this->dto->getPassword()
        );

        if ($id === null) {
            return null;
        }

        return $this->jwt->create((string) $id);
    }
}
