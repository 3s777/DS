<?php

namespace Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Support\Filters\AbstractFilter;
use Tests\TestCase;

class AbstractFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter_created_success(): void
    {
        $request = Request::create('/', 'GET', [
            'filters' => [
                'test-key' => 'something_for_filtering',
            ],
        ]);

        $this->app->instance('request', $request);

        $filter = new class (
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            'test-placeholder'
        ) extends AbstractFilter {
            public function apply(Builder $query): Builder
            {
                return $query;
            }

            public function preparedValues(): mixed
            {
                return 'test-values';
            }

            public function view(): string
            {
                return 'test-view';
            }
        };

        $view = $filter->badgeView();

        $this->assertSame('test-title', $filter->title());
        $this->assertSame('test-key', $filter->key());
        $this->assertSame('test-placeholder', $filter->placeholder());
        $this->assertSame('something_for_filtering', $filter->requestValue());
        $this->assertSame('filters[test-key]', $filter->name());
        $this->assertSame('filters[test-key][from]', $filter->name('from'));
        $this->assertSame('filters_test-key', $filter->id());
        $this->assertSame('filters_test-key_from', $filter->id('from'));
        $this->assertInstanceOf(View::class, $view);
        $this->assertSame('components.common.filters.badge', $view->name());
        $this->assertArrayHasKey('filter', $view->getData());
        $this->assertSame($filter, $view->getData()['filter']);
    }

    public function test_filter_created_with_placeholder_array_success(): void
    {
        $filter = new class (
            'test-title',
            'test-key',
            'test-table',
            'test-field',
            [
                'from' => 'test-placeholder-from',
                'to' => 'test-placeholder-to'
            ]
        ) extends AbstractFilter {
            public function apply(Builder $query): Builder
            {
                return $query;
            }

            public function preparedValues(): mixed
            {
                return 'test-values';
            }

            public function view(): string
            {
                return 'test-view';
            }
        };

        $this->assertSame('test-placeholder-from', $filter->placeholder('from'));
        $this->assertSame('test-placeholder-to', $filter->placeholder('to'));
    }

    public function test_filter_created_without_additional_parameters_success(): void
    {
        $filter = new class (
            'test-title',
            'test-key',
            'test-table'
        ) extends AbstractFilter {
            public function apply(Builder $query): Builder
            {
                return $query;
            }

            public function preparedValues(): mixed
            {
                return 'test-values';
            }

            public function view(): string
            {
                return 'test-view';
            }
        };

        $this->assertInstanceOf(AbstractFilter::class, $filter);
    }
}
