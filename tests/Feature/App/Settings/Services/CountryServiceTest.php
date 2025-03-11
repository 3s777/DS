<?php

namespace App\Settings\Services;

use App\Http\Requests\Settings\Admin\CreateCountryRequest;
use Domain\Auth\Models\User;
use Domain\Settings\DTOs\FillCountryDTO;
use Domain\Settings\Models\Country;
use Domain\Settings\Services\CountryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tests\TestCase;

class CountryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCountryRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_country_created_success(): void
    {
        $this->assertDatabaseMissing('countries', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $request = new Request($this->request);

        $countryService = app(CountryService::class);

        $countryService->create(FillCountryDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('countries', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_country_updated_success(): void
    {

        $createRequest = new Request($this->request);

        $CountryService = app(CountryService::class);

        $CountryService->create(FillCountryDTO::fromRequest(
            $createRequest
        ));

        $Country = Country::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNameCountry';
        $this->request['slug'] = 'newslug';

        $updateRequest = new Request($this->request);

        $CountryService->update($Country, FillCountryDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('countries', [
            'slug' => 'newslug',
        ]);

        $updatedCountry = Country::where('slug', 'newslug')->first();

        $this->assertSame($updatedCountry->slug, $this->request['slug']);
    }
}
