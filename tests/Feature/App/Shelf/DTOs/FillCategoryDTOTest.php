<?php

namespace App\Shelf\DTOs;

use App\Http\Requests\Shelf\CreateCategoryRequest;
use Domain\Shelf\DTOs\FillCategoryDTO;
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

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillCategoryDTO::fromRequest(new CreateCategoryRequest($this->request));

        $this->assertInstanceOf(FillCategoryDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillCategoryDTO::make(
            name: $this->request['name'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillCategoryDTO::class, $data);
    }
}
