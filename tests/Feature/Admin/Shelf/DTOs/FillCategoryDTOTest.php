<?php

namespace Admin\Shelf\DTOs;

use App\Admin\Http\Requests\Shelf\CreateCategoryRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillCategoryDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCategoryRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillCategoryDTO::fromRequest(new CreateCategoryRequest($this->request));

        $this->assertInstanceOf(FillCategoryDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillCategoryDTO::make(
            name: $this->request['name'],
            model: $this->request['model'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillCategoryDTO::class, $data);
    }
}
