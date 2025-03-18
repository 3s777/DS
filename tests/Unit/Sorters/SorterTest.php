<?php

namespace Sorters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Support\Sorters\Sorter;
use Tests\TestCase;

class SorterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_sorted_success(): void
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

        $query->shouldReceive('orderBy')
            ->with('test-key', 'asc')
            ->once()
            ->andReturn($query);

        $sorter->run($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_sorted_desc_success(): void
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

        $query->shouldReceive('orderBy')
            ->with('test-key', 'desc')
            ->once()
            ->andReturn($query);

        $sorter->run($query);
    }

    /**
     * @test
     * @return void
     */
    public function it_sortData_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_key_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_order_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_columns_success(): void
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
