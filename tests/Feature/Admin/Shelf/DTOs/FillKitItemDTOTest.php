<?php

namespace Admin\Shelf\DTOs;

use App\Admin\Http\Requests\Shelf\CreateKitItemRequest;
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

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillKitItemDTO::fromRequest(new CreateKitItemRequest($this->request));

        $this->assertInstanceOf(FillKitItemDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillKitItemDTO::make(
            name: $this->request['name'],
        );

        $this->assertInstanceOf(FillKitItemDTO::class, $data);
    }
}
