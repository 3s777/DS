<?php

namespace App\Shelf\DTOs;

use App\Http\Requests\Shelf\CreateShelfRequest;
use Domain\Shelf\DTOs\FillShelfDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillShelfDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateShelfRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillShelfDTO::fromRequest(new CreateShelfRequest($this->request));

        $this->assertInstanceOf(FillShelfDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillShelfDTO::make(
            name: $this->request['name'],
            number: $this->request['number'],
            description: $this->request['description'],
        );

        $this->assertInstanceOf(FillShelfDTO::class, $data);
    }
}
