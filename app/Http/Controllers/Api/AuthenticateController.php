<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;


use App\Http\Responses\Api\AuthenticateLogoutResolver;
use App\Http\Responses\Api\AuthenticateLogoutResponder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use App\Http\Responses\Api\AuthenticateResolver;
use App\Http\Responses\Api\AuthenticateResponder;
use App\Http\Requests\Api\AuthenticateFormRequest;

final class AuthenticateController
{
    public function authenticate(AuthenticateFormRequest $request, AuthenticateResolver $resolver, AuthenticateResponder $responder): Response
    {
        try {
            return $responder->respond(
                $resolver->with($request->toDto())
            );
        } catch (Throwable $e) {
            return $responder->error($e);
        }
    }

    public function logout(AuthenticateLogoutResolver $resolver, AuthenticateLogoutResponder $responder, Request $request): Response
    {
        try {
            return $responder->respond(
                $resolver->with(
                    $request->bearerToken()
                )
            );
        } catch (Throwable $e) {
            return $responder->error($e);
        }
    }

}
