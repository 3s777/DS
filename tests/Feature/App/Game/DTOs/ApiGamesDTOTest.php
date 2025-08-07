<?php

namespace App\Game\DTOs;

use Domain\Game\DTOs\ApiGamesDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiGamesDTOTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_created_success(): void
    {
        $data = ApiGamesDTO::make(
            'game name',
            ['alternative name 1', 'alternative name 2'],
            'game date',
            'game description',
            ['publisher 1', 'publisher 2'],
            ['developer 1', 'developer 2'],
            ['genre 1', 'genre 2'],
            ['platform 1', 'platform 2'],
        );

        $this->assertInstanceOf(ApiGamesDTO::class, $data);
    }
}
