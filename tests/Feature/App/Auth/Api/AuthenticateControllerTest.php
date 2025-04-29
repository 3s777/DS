<?php

namespace App\Auth\Api;

use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;

final class AuthenticateControllerTest extends TestCase
{
    use RefreshDatabase;

    private function tokenRequest(bool $invalid = false): TestResponse
    {
        $user = User::factory()->create([
            'email' => 'test@test.test',
            'password' => bcrypt('secret')
        ]);

        return $this->postJson(route('api.authenticate'), [
            'email' => $user->email,
            'password' => $invalid ? 'password' : 'secret',
        ]);
    }

//    /**
//     * @test
//     * @return void
//     */
//    public function it_successful_authenticate(): void
//    {
//        $response = $this->tokenRequest();
//
//        $response
//            ->assertOk()
//            ->assertJsonStructure([
//                'data' => [
//                    'type',
//                    'id',
//                    'attributes' => [
//                        'token'
//                    ]
//                ],
//                'links'
//            ]);
//
//        $token = $response->json('data.id');
//
//        $this->assertStringContainsString('.', $token);
//    }
//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_failed_authenticate(): void
//    {
//        $response = $this->tokenRequest(true);
//
//        $response->assertUnauthorized();
//    }
//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_expired_token(): void
//    {
//        $response = $this->tokenRequest();
//
//        $token = $response->json('data.id');
//
//        $this
//            ->withToken($token)
//            ->deleteJson(route('api.logout'))
//            ->assertNoContent();
//
//        $this->travelTo(now()->addDay());
//
//        $this
//            ->withToken($token)
//            ->deleteJson(route('api.logout'))
//            ->assertUnauthorized();
//    }
//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_token_is_invalid(): void
//    {
//        $this
//            ->withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c')
//            ->deleteJson(route('api.logout'))
//            ->assertUnauthorized()
//            ->assertJsonStructure([
//                'errors'
//            ]);
//    }

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

//    /**
//     * @test
//     * @return void
//     */
//    public function it_token_in_blacklist(): void
//    {
//        $response = $this->tokenRequest();
//
//        $token = $response->json('data.id');
//
//        $this
//            ->withToken($token)
//            ->deleteJson(route('api.logout'))
//            ->assertNoContent();
//
//        $this
//            ->withToken($token)
//            ->deleteJson(route('api.logout'))
//            ->assertUnauthorized();
//    }
}
