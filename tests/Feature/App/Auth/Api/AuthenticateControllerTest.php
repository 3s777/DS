<?php

namespace App\Auth\Api;

use App\Enums\ApiErrorCode;
use App\Http\Responses\Api\TokenResponse;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Traits\ApiRequests;

final class AuthenticateControllerTest extends TestCase
{
    use RefreshDatabase;
    use ApiRequests;

    /**
     * @test
     * @return void
     */
    public function it_successful_authenticate(): void
    {
        $response = $this->tokenRequest();

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'token',
                        'refresh_token'
                    ]
                ],
                'links'
            ]);

        $token = $response->json('data.id');
        $refreshToken = $response->json('data.attributes.refresh_token');

        $this->assertStringContainsString('.', $token);

        $response->assertJson(
            app(TokenResponse::class)->withTokens($token, $refreshToken)->toArray()
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_failed_authenticate(): void
    {
        $response = $this->tokenRequest(true);

        $response
            ->assertUnprocessable()
            ->assertJson(
                app(TokenResponse::class)->toFailure(
                    ApiErrorCode::CREDENTIALS_INVALID,
                    Response::HTTP_UNPROCESSABLE_ENTITY
                )->toArray()
            );


    }

    /**
     * @test
     * @return void
     */
    public function it_expired_token(): void
    {
        $response = $this->tokenRequest();

        $token = $response->json('data.id');

        $this
            ->withToken($token)
            ->deleteJson(route('api.logout'))
            ->assertNoContent();

        $this->travelTo(now()->addDay());

        $this
            ->withToken($token)
            ->deleteJson(route('api.logout'))
            ->assertUnauthorized()
            ->assertJson(
                app(TokenResponse::class)->toFailure(
                    ApiErrorCode::TOKEN_EXPIRED,
                    Response::HTTP_UNAUTHORIZED
                )->toArray()
            );
    }

    /**
     * @test
     * @return void
     */
    public function it_token_is_invalid(): void
    {
        $this
            ->withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c')
            ->deleteJson(route('api.logout'))
            ->assertUnauthorized()
            ->assertJsonStructure([
                'errors'
            ])
            ->assertJson(
                app(TokenResponse::class)->toFailure(
                    ApiErrorCode::TOKEN_INVALID,
                    Response::HTTP_UNAUTHORIZED
                )->toArray()
            );
    }

    /**
     * @test
     * @return void
     */
    public function it_successful_logout(): void
    {
        $response = $this->tokenRequest();

        $token = $response->json('data.id');

        $this
            ->withToken($token)
            ->deleteJson(route('api.logout'))
            ->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function it_token_in_blacklist(): void
    {
        $response = $this->tokenRequest();

        $token = $response->json('data.id');

        $this
            ->withToken($token)
            ->deleteJson(route('api.logout'))
            ->assertNoContent();

        $this
            ->withToken($token)
            ->deleteJson(route('api.logout'))
            ->assertUnauthorized();
    }

    /**
     * @test
     * @return void
     */
    public function it_token_refreshed_successful(): void
    {
        $response = $this->tokenRequest();

        $refreshToken = $response->json('data.attributes.refresh_token');

        $this->travelTo(now()->toImmutable()->addHours(2));

        $response = $this->putJson(route('api.refresh'), [
            'refresh_token' => $refreshToken,
        ]);

        $token = $response->json('data.id');

        $refreshToken = $response->json('data.attributes.refresh_token');

        $response->assertJson(
            app(TokenResponse::class)->withTokens($token, $refreshToken)->toArray()
        );
    }
}
