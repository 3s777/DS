<?php

namespace Admin\Settings\DTOs;

use App\Admin\Http\Requests\Settings\CreateCountryRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FillCountryDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCountryRequest::factory()->create();
    }

    public function test_instance_created_from_create_request_success(): void
    {
        $data = FillCountryDTO::fromRequest(new CreateCountryRequest($this->request));

        $this->assertInstanceOf(FillCountryDTO::class, $data);
    }


    public function test_instance_created_success(): void
    {
        $data = FillCountryDTO::make(
            name: $this->request['name'],
        );

        $this->assertInstanceOf(FillCountryDTO::class, $data);
    }
}
