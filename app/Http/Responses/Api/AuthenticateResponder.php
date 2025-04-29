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
class AuthenticateResponder extends AbstractApiResponder
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
        return [
            'self' => route('api.authenticate'),
            'logout' => route('api.logout'),
        ];
    }

    public function respond(ResponseResolverContract $resolver): Response
    {
        $token = $resolver->resolve();

        if ($token === null) {
            return $this->response->json(
                $this->errorResponse('user credentials', 'Credentials is invalid'),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->response->json(
            $this->successResponse($token, [
                'token' => $token,
            ])
        );
    }

    public function error(Throwable $e): Response
    {
        return $this->response->json(
            $this->errorResponse('authenticate', 'Authenticate error'),
            Response::HTTP_UNAUTHORIZED
        );
    }
}
