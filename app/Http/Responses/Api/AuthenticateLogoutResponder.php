<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\Api\ResponderContract;
use App\Contracts\Api\ResponseResolverContract;
use Throwable;
use App\Http\Responses\Api\AuthenticateLogoutResolver;

/**
* @implements ResponderContract<AuthenticateLogoutResolver>
**/
class AuthenticateLogoutResponder extends AbstractApiResponder
{
    public function __construct(private readonly ResponseFactory $response)
    {

    }

    public function type(): string
    {
        return 'tokens';
    }

    public function links(): array
    {
        return [];
    }

    public function respond(ResponseResolverContract $resolver): Response
    {
        $resolver->resolve();

        return $this->response->noContent();
    }

    public function error(Throwable $e): Response
    {
        return $this->response->json(
            $this->errorResponse('authenticate', 'Authenticate error'),
            Response::HTTP_UNAUTHORIZED
        );
    }
}
