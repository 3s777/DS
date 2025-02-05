<?php

namespace App\Auth\Admin\DTOs;

use App\Http\Requests\Auth\Collector\CreateCollectorRequest;
use Domain\Auth\DTOs\UpdateCollectorDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCollectorDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCollectorRequest::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_form_request_success(): void
    {
        $data = UpdateCollectorDTO::fromRequest(new CreateCollectorRequest($this->request));

        $this->assertInstanceOf(UpdateCollectorDTO::class, $data);
    }

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {

        $data = UpdateCollectorDTO::make(
            $this->request['name'],
            $this->request['email'],
            $this->request['language'],
            $this->request['roles'],
            $this->request['permissions'],
            $this->request['password'],
            $this->request['first_name'],
            $this->request['slug'],
            $this->request['description'],
            $this->request['featured_image'],
            $this->request['featured_image_uploaded'],
            $this->request['is_verified'],
        );

        $this->assertInstanceOf(UpdateCollectorDTO::class, $data);
    }
}
