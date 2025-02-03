<?php

namespace App\Shelf\DTOs;

use App\Http\Requests\Shelf\Admin\CreateKitItemRequest;
use Domain\Shelf\DTOs\FillKitItemDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillKitItemDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateKitItemRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillKitItemDTO::fromRequest(new CreateKitItemRequest($this->request));

        $this->assertInstanceOf(FillKitItemDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillKitItemDTO::make(
            name: $this->request['name'],
        );

        $this->assertInstanceOf(FillKitItemDTO::class, $data);
    }
}
