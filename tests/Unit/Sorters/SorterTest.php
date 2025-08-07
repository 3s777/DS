<?php

namespace Sorters;

use Domain\Auth\Models\User;
use Domain\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Support\Sorters\Sorter;
use Tests\TestCase;

class SorterTest extends TestCase
{
    use RefreshDatabase;

    public function test_sorted_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key']
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

        $query->shouldReceive('getModel')
            ->once()
            ->andReturn(new User());

        $query->shouldReceive('orderBy')
            ->with('test-key', 'asc')
            ->once()
            ->andReturn($query);

        $sorter->run($query);
    }

    public function test_sorted_desc_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
            'order' => 'desc'
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key', 'tes-key-2']
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

        $query->shouldReceive('getModel')
            ->once()
            ->andReturn(new User());

        $query->shouldReceive('orderBy')
            ->with('test-key', 'desc')
            ->once()
            ->andReturn($query);

        $sorter->run($query);
    }

    public function test_sorted_with_translations_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'name',
        ]);

        $locale = app()->getLocale();

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['name']
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

        $query->shouldReceive('getModel')
            ->once()
            ->andReturn(new Page());

        $query->shouldReceive('orderByRaw')
            ->with('pages.name->>\''.$locale.'\' asc')
            ->once()
            ->andReturn($query);

        $sorter->run($query);
    }

    public function test_sortData_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
            'order' => 'desc'
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key', 'tes-key-2']
        );

        $sortData = $sorter->sortData();

        $this->assertSame($sortData['key']->value(), 'test-key');
        $this->assertSame($sortData['order']->value(), 'desc');
    }

    public function test_key_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
            'order' => 'desc'
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key', 'tes-key-2']
        );

        $this->assertSame($sorter->key(), 'sort');
    }

    public function test_order_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
            'order' => 'desc'
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key', 'tes-key-2']
        );

        $this->assertSame($sorter->order(), 'order');
    }

    public function test_columns_success(): void
    {
        $request = Request::create('/', 'GET', [
            'sort' => 'test-key',
            'order' => 'desc'
        ]);

        $this->app->instance('request', $request);

        $sorter = new Sorter(
            ['test-key', 'tes-key-2']
        );

        $this->assertSame($sorter->columns(), ['test-key', 'tes-key-2']);
    }
}
