<?php

namespace App\Auth\Api;

use App\Enums\ApiErrorCode;
use App\Http\Responses\Api\TokenResponse;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Traits\ApiRequests;

final class CollectorsControllerTest extends TestCase
{
    use RefreshDatabase;
    use ApiRequests;

    /**
     * @test
     * @return void
     */
    public function it_successful_index_response(): void
    {
        $token = $this->tokenRequest()->json('data.id');

        Collector::factory(2)->create();

//        $this->withToken($token)->getJson(
//            route('api.collectors.index')
//        );

//        dd($this->withToken($token)
//            ->getJson(route('api.collectors.index')));

        $response = $this->withToken($token)
            ->getJson(route('api.collectors.index'));

        $response
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'type',
                        'id',
                        'attributes' => [
                            'id',
                            'name'
                        ]
                    ]
                ],
                'links'
            ]);
    }

}
