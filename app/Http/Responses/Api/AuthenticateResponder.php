<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use App\Dto\AuthenticateDto;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\Api\ResponderContract;
use App\Contracts\Api\ResponseResolverContract;
use Throwable;
use App\Http\Responses\Api\AuthenticateResolver;

/**
* @implements ResponderContract<AuthenticateResolver>
**/
class AuthenticateResponder implements ResponderContract
{

    public function __construct(private readonly ResponseFactory $response)
    {

    }

    public function respond(ResponseResolverContract $resolver): Response
    {
        $token = $resolver->resolve();

        if ($token === null) {
            return $this->response->json([]);
        }

        return $this->response->json([
            'token' => $token
        ]);
    }

    public function error(Throwable $e): Response
    {
        return $this->response->json([
            'errors' => []
        ]);
    }
}
