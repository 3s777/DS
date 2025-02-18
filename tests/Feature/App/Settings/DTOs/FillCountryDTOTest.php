<?php

namespace App\Settings\DTOs;

use App\Http\Requests\Settings\Admin\CreateCountryRequest;
use Domain\Settings\DTOs\FillCountryDTO;
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

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_create_request_success(): void
    {
        $data = FillCountryDTO::fromRequest(new CreateCountryRequest($this->request));

        $this->assertInstanceOf(FillCountryDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = FillCountryDTO::make(
            name: $this->request['name'],
        );

        $this->assertInstanceOf(FillCountryDTO::class, $data);
    }
}
