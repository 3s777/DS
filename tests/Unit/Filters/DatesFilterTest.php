<?php

namespace Filters;

use App\Filters\DatesFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Mockery;
use Tests\TestCase;

class DatesFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter_created_and_apply_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '2025-01-01',
                    'to' => '2025-02-01'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test_from',
                'to' => 'test_to'
            ]
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
                Carbon::createFromFormat('Y-m-d', '2025-01-01')
                    ->startOfDay(),
                Carbon::createFromFormat('Y-m-d', '2025-02-01')
                    ->endOfDay()
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_apply_with_relation_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '2025-01-01',
                    'to' => '2025-02-01'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test_from',
                'to' => 'test_to'
            ],
            'test-relation'
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
                Carbon::createFromFormat('Y-m-d', '2025-01-01')
                    ->startOfDay(),
                Carbon::createFromFormat('Y-m-d', '2025-02-01')
                    ->endOfDay()
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_methods_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '2025-01-01',
                    'to' => '2025-02-01'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test_from',
                'to' => 'test_to'
            ],
            'test-relation'
        );

        $this->assertSame('test_from', $filter->placeholder('from'));
        $this->assertSame('test_to', $filter->placeholder('to'));
        $this->assertSame('components.common.filters.dates', $filter->view());
        $this->assertSame('01.01.2025 - 01.02.2025', $filter->preparedValues());
    }


    public function test_filter_only_from_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'from' => '2025-01-01'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test_from',
                'to' => 'test_to'
            ]
        );

        $this->assertSame('01.01.2025', $filter->preparedValues());

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
                Carbon::createFromFormat('Y-m-d', '2025-01-01')
                    ->startOfDay(),
                Carbon::createFromFormat('Y-m-d', '3000-01-01')
                    ->endOfDay()
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_only_to_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'to' => '2025-02-01'
                ]
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title-dates',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test_from',
                'to' => 'test_to'
            ]
        );

        $this->assertSame('01.02.2025', $filter->preparedValues());

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
                Carbon::createFromFormat('Y-m-d', '0001-01-01')
                    ->startOfDay(),
                Carbon::createFromFormat('Y-m-d', '2025-02-01')
                    ->endOfDay()
            ])
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_without_additional_parameters_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => 'test-key-value',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new DatesFilter(
            'test-title',
            'test-key',
            'test-table',
        );

        $this->assertNull($filter->placeholder());
    }
}
