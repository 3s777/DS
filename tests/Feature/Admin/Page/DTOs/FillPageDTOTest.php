<?php

namespace Admin\Page\DTOs;

use App\Admin\Http\Requests\Page\CreatePageRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillPageDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePageRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillPageDTO::fromRequest(new CreatePageRequest($this->request));

        $this->assertInstanceOf(FillPageDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillPageDTO::make(
            name: $this->request['name'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillPageDTO::class, $data);
    }
}
