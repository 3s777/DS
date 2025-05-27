<?php

namespace Filters;

use App\Filters\RelationMultipleFilter;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class RelationMultipleFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_filter_created_and_apply_success(): void
    {
        $shelves = Shelf::factory(2)->create();

        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => $shelves->pluck('id')->toArray()
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RelationMultipleFilter(
            'test-title',
            'test-key',
            'test-table',
            Shelf::class,
            'test-field',
            'test-placeholder'
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

        $query->shouldReceive('whereHas')
            ->once()
            ->andReturnUsing(function ($value, $callback) use ($query) {
                if ($value) {
                    $callback($query);
                }
                return $query;
            });

        $query->shouldReceive('whereIn')
            ->with('test-table.test-field', $shelves->pluck('id')->toArray())
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_methods_success(): void
    {
        $shelves = Shelf::factory(2)->create();
        $shelf = Shelf::factory()->create();

        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => $shelves->pluck('id')->toArray()
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RelationMultipleFilter(
            'test-title',
            'test-key',
            'test-table',
            Shelf::class,
            placeholder: 'test-placeholder'
        );

        $this->assertSame($shelves->pluck('name')->toArray(), $filter->preparedValues());
        $this->assertSame(Shelf::all()->pluck('name', 'id')->toArray(), $filter->getPreparedOptions());
        $this->assertSame($shelves->pluck('id')->toArray(), $filter->preparedSelected());
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_async_success(): void
    {
        $shelves = Shelf::factory(2)->create();
        $shelf = Shelf::factory()->create();

        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => $shelves->pluck('id')->toArray()
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RelationMultipleFilter(
            'test-title',
            'test-key',
            'test-table',
            Shelf::class,
            placeholder: 'test-placeholder',
            async: true
        );

        $this->assertSame($shelves->pluck('name', 'id')->toArray(), $filter->preparedSelected());
    }
}
