<?php

namespace Filters;

use App\Filters\RangeFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class RangeFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_filter_created_and_apply_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '12',
                    'to' => '130'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title',
            'test-key',
            'test-table',
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

        $query->shouldReceive('whereBetween')
            ->with('test-table.test-field', [
                12,
                130
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_created_and_apply_with_price_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '12',
                    'to' => '130'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder',
            isPrice: true,
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

        $query->shouldReceive('whereBetween')
            ->with('test-table.test-field', [
                1200,
                13000
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_apply_with_relation_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '12',
                    'to' => '130'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder',
            relation: 'test-relation'
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

        $query->shouldReceive('whereBetween')
            ->with('test-table.test-field', [
                12,
                130
            ])
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
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => 13,
                    'to' => 120
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder',
            relation: 'test-relation'
        );

        $this->assertSame('test-placeholder', $filter->placeholder());
        $this->assertSame('13 - 120', $filter->preparedValues());
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_only_from_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => 11
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder'
        );

        $this->assertSame('11', $filter->preparedValues());

        $query = Mockery::mock(Builder::class);

        $query->shouldReceive('when')
            ->once()
            ->andReturnUsing(function ($value, $callback) use ($query) {
                if ($value) {
                    $callback($query);
                }
                return $query;
            });

        $query->shouldReceive('whereBetween')
            ->with('test-table.test-field', [
                11,
                100000000
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_only_to_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'to' => 20
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field'
        );

        $this->assertSame('20', $filter->preparedValues());

        $query = Mockery::mock(Builder::class);

        $query->shouldReceive('when')
            ->once()
            ->andReturnUsing(function ($value, $callback) use ($query) {
                if ($value) {
                    $callback($query);
                }
                return $query;
            });

        $query->shouldReceive('whereBetween')
            ->with('test-table.test-field', [
                0,
                20
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_filter_without_additional_parameters_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => 'test-key-value',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new RangeFilter(
            'test-title',
            'test-key',
            'test-table',
        );

        $this->assertSame('test-title', $filter->placeholder());
    }
}
