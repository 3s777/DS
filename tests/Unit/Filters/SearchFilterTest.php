<?php

namespace Filters;

use App\Filters\SearchFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
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
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => '56',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new SearchFilter(
            'test-name',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder',
            ['test-alternative-fields' => 'test']
        );

        $query = Mockery::mock(Builder::class);

        $query->shouldReceive('when')
            ->once()
            ->andReturnUsing(function ($value, $callback) use ($query) {
            if ($value) {
                $callback($query);
            }
            return $query;
        });

        $query->shouldReceive('where')
            ->with('test-table.test-field', 'ILIKE', '%'.$filter->requestValue().'%')
            ->once()
            ->andReturn($query);

        $query->shouldReceive('orWhere')
            ->with('test-table.test', 'ILIKE', '%'.$filter->requestValue().'%')
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }
}
