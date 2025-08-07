<?php

namespace Filters;

use App\Filters\EnumFilter;
use Domain\Shelf\Enums\ConditionEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class EnumFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter_created_and_apply_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => 'test-key-value',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new EnumFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-enum',
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
            ->with('test-table.test-field', $filter->requestValue())
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_apply_with_array_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => [
                    'test-key-value', 'test-key-value-2'
                ],
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new EnumFilter(
            'test-title',
            'test-key',
            'test-table',
            'test-enum',
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

        $query->shouldReceive('whereIn')
            ->with('test-table.test-field', $filter->requestValue())
            ->once()
            ->andReturn($query);

        $filter->apply($query);
    }

    public function test_filter_methods_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => 'new',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new EnumFilter(
            'test-title',
            'test-key',
            'test-table',
            ConditionEnum::class,
            'test-field',
            'test-placeholder',
        );

        $this->assertSame('test-placeholder', $filter->placeholder());
        $this->assertSame(ConditionEnum::cases(), $filter->options());
        $this->assertSame(ConditionEnum::tryFrom('new')->name(), $filter->preparedValues());
    }

    public function test_filter_preparedValues_with_array_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => ['new', 'used'],
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new EnumFilter(
            'test-title',
            'test-key',
            'test-table',
            ConditionEnum::class,
        );

        $this->assertSame([
            ConditionEnum::tryFrom('new')->name(),
            ConditionEnum::tryFrom('used')->name()
        ], $filter->preparedValues());
    }

    public function test_filter_with_callbackPreparedValues_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => ['new', 'used'],
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new EnumFilter(
            'test-title',
            'test-key',
            'test-table',
            ConditionEnum::class,
            callbackPreparedValues: function () {
                return 'test-prepared';
            }
        );

        $this->assertSame('test-prepared', $filter->preparedValues());
    }
}
