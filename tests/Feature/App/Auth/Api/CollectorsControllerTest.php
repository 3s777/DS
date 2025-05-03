<?php

namespace App\Auth\Api;

use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
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
