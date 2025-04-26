<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Throwable;
use App\Http\Responses\Api\AuthenticateResolver;
use App\Http\Responses\Api\AuthenticateResponder;
use App\Http\Requests\Api\AuthenticateFormRequest;

final class AuthenticateController
{
    public function __invoke(AuthenticateFormRequest $request, AuthenticateResolver $resolver, AuthenticateResponder $responder): Response
    {
        try {
            return $responder->respond(
                $resolver->with($request->toDto())
            );
        } catch (Throwable $e) {
            return $responder->error($e);
        }
    }

}
