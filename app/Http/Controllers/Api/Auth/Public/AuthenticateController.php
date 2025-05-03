<?php

namespace App\Http\Controllers\Api\Auth\Public;

use App\Http\Requests\Api\Auth\Public\AuthenticateFormRequest;
use App\Http\Requests\Api\Auth\Public\RefreshTokenFormRequest;
use App\Http\Responses\Api\TokenResponse;
use Domain\Auth\Actions\Api\CreateTokenAction;
use Domain\Auth\Actions\Api\RefreshTokenAction;
use Support\Enums\ApiErrorCode;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticateController
{
    public function authenticate(AuthenticateFormRequest $request, CreateTokenAction $action, TokenResponse $response): TokenResponse
    {
        [$token, $refresh] = $action->handle($request->toDto());

        if ($token === null) {
            return $response->toFailure(
                ApiErrorCode::CREDENTIALS_INVALID,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $response->withTokens($token, $refresh);
    }

    public function logout(): Response
    {
        auth()->logout();

        return response()->noContent();
    }

    public function refresh(RefreshTokenFormRequest $request, RefreshTokenAction $action, TokenResponse $response): TokenResponse
    {
        [$token, $refresh] = $action->handle(
            $request->input('refresh_token')
        );

        if ($token === null) {
            return $response->toFailure(
                ApiErrorCode::TOKEN_REFRESH_FAILED,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $response->withTokens($token, $refresh);
    }

}
