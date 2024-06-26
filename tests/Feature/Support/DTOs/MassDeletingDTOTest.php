<?php

namespace Support\DTOs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MassDeletingDTOTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = MassDeletingDTO::make(
            'Domain\Game\Models\GameDeveloper',
            '11,12,22',
            true
        );

        $this->assertInstanceOf(MassDeletingDTO::class, $data);
    }
}
