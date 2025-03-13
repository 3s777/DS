<?php

namespace Filters;

use App\Filters\RelationFilter;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class RelationFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_filter_created_and_apply_success(): void
    {
        $shelf = Shelf::factory()->create();

        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => $shelf->id,
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RelationFilter(
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

        $query->shouldReceive('where')
            ->with('test-table.test-field',  $shelf->id)
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
        $shelf = Shelf::factory()->create();

        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => $shelf->id,
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RelationFilter(
            'test-title',
            'test-key',
            'test-table',
            Shelf::class,
            'test-field',
            'test-placeholder'
        );

        $this->assertSame($shelf->name, $filter->preparedValues());
        $this->assertSame($shelf->pluck('name', 'id')->toArray(), $filter->getPreparedOptions());
    }
}
