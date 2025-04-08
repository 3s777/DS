<?php

namespace App\Page\DTOs;

use App\Http\Requests\Page\Admin\CreatePageRequest;
use Domain\Page\DTOs\FillPageDTO;
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

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillPageDTO::fromRequest(new CreatePageRequest($this->request));

        $this->assertInstanceOf(FillPageDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillPageDTO::make(
            name: $this->request['name'],
            description: $this->request['description']
        );

        $this->assertInstanceOf(FillPageDTO::class, $data);
    }
}
