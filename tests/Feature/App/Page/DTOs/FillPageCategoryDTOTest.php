<?php

namespace App\Page\DTOs;

use App\Http\Requests\Page\Admin\CreatePageCategoryRequest;
use Admin\Page\DTOs\FillPageCategoryDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillPageCategoryDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePageCategoryRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillPageCategoryDTO::fromRequest(new CreatePageCategoryRequest($this->request));

        $this->assertInstanceOf(FillPageCategoryDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {
        $data = FillPageCategoryDTO::make(
            name: $this->request['name'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillPageCategoryDTO::class, $data);
    }
}
