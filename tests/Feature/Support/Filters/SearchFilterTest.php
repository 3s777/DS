<?php

namespace Feature\Support\Filters;

use App\Filters\SearchFilter;
use Domain\Shelf\FilterRegistrars\CollectibleFilterRegistrar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Support\DTOs\MassDeletingDTO;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $filter = new SearchFilter(
            'test-name',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder',
            ['test-alternative-fields' => 'test']
        );

        // Создаем mock-запрос с нужными параметрами
        $request = Request::create('/', 'GET', [
            'filters' => [
                'name' => 'sdfsdf',
            ],
        ]);

        dd($filter->preparedValues());


dd(app(CollectibleFilterRegistrar::class)->filtersList());
        dd($filter->preparedValues());

        $this->assertInstanceOf(MassDeletingDTO::class, $data);
    }
}
