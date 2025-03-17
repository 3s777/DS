<?php

namespace Tests\Traits;

use Carbon\Carbon;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

trait HasFilters
{
    abstract public function getFactory(): Factory;
    abstract public function getAction(): array;
    abstract public function getUser(): User;
    abstract public function getViewData(): string;

    abstract public function getModels(): Collection;

    public function baseAssertion(array $request, Model $expectedModel, Collection $models): void
    {
        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($models->pluck('name')->toArray());
    }

    public function searchFilter(string $filterName = 'search', string $field = 'name'): void
    {
        $expectedModel = $this->getFactory()
            ->create([$field => 'search test']);

        $request = [
            'filters' => [
                $filterName => 'test'
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $this->getModels());
    }

    public function valueFilter(string $filterName, string $field, bool $multiple = false): void
    {
        $expectedModel = $this->getFactory()
            ->create([$field => 'search test']);

        $request = [
            'filters' => [
                $filterName => 'search test'
            ]
        ];

        if($multiple) {
            $request = [
                'filters' => [
                    $filterName => ['search test']
                ]
            ];
        }

        $this->baseAssertion($request, $expectedModel, $this->getModels());
    }

    public function datesFilter(
        string $filterName = 'dates',
        string $field = 'created_at'
    ): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => Carbon::tomorrow()]);

        $expectedModel = $this->getFactory()
            ->create([$field => Carbon::yesterday()]);

        $request = [
            'filters' => [
                $filterName => [
                    'from' => Carbon::yesterday()->format('Y-m-d'),
                    'to' => Carbon::yesterday()->format('Y-m-d')
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function datesRelationFilter(
        string $relationClass,
        string $relationName,
        string $filterName = 'dates',
        string $field = 'created_at',
    ): void
    {
        $models = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::tomorrow()
            ]), $relationName)
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::yesterday()
            ]), $relationName)
            ->create();

        $request = [
            'filters' => [
                $filterName => [
                    'from' => Carbon::yesterday()->format('Y-m-d'),
                    'to' => Carbon::yesterday()->format('Y-m-d')
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function datesRelationFromFilter(
        string $relationClass,
        string $relationName,
        string $filterName = 'dates',
        string $field = 'created_at',
    ): void
    {
        $models = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::yesterday()
            ]), $relationName)
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::now()
            ]), $relationName)
            ->create();

        $request = [
            'filters' => [
                $filterName => [
                    'from' => Carbon::now()->format('Y-m-d'),
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function datesRelationToFilter(
        string $relationClass,
        string $relationName,
        string $filterName = 'dates',
        string $field = 'created_at',
    ): void
    {
        $models = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::tomorrow()
            ]), $relationName)
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has($relationClass::factory()->state([
                $field => Carbon::yesterday()
            ]), $relationName)
            ->create();

        $request = [
            'filters' => [
                $filterName => [
                    'to' => Carbon::yesterday()->format('Y-m-d')
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function datesFromFilter(string $filterName = 'dates', string $field = 'created_at'): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => Carbon::yesterday()]);

        $expectedModel = $this->getFactory()
            ->create([$field => Carbon::now()]);

        $request = [
            'filters' => [
                $filterName => ['from' => Carbon::now()->format('Y-m-d')]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function datesToFilter(string $filterName = 'dates', string $field = 'created_at'): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => Carbon::tomorrow()]);

        $expectedModel = $this->getFactory()
            ->create([$field => Carbon::yesterday()]);

        $request = [
            'filters' => [
                $filterName => ['to' => Carbon::yesterday()->format('Y-m-d')]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function userFilter(
        string $filterName = 'user',
        string $field = 'user_id',
        string $userModel = User::class
    ): void
    {
        $user = $userModel::factory()->create();

        $expectedModel = $this->getFactory()
            ->create([$field => $user->id]);

        $request = [
            'filters' => [
                $filterName => $user->id
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $this->getModels());
    }

    public function rangeFilter(string $filterName, string $field): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => fn() => rand(1,5)]);

        $expectedModel = $this->getFactory()
            ->create([$field => 10]);

        $request = [
            'filters' => [
                $filterName => [
                    'from' => 6,
                    'to' => 11
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function rangeFromFilter(string $filterName, string $field): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => fn() => rand(1,5)]);

        $expectedModel = $this->getFactory()
            ->create([$field => 10]);

        $request = [
            'filters' => [
                $filterName => [
                    'from' => 6
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function rangeToFilter(string $filterName, string $field): void
    {
        $models = $this->getFactory()
            ->count(10)
            ->create([$field => fn() => rand(5,10)]);

        $expectedModel = $this->getFactory()
            ->create([$field => 3]);

        $request = [
            'filters' => [
                $filterName => [
                    'to' => 4
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function relationFilter(
        string $filterName,
        string $relationModel,
        string $relationName
    ): void
    {
        $relationModels = $relationModel::factory(3)->create();
        $expectedModels = $this->getFactory()
            ->count(2)
            ->hasAttached($relationModels, relationship: $relationName)
            ->create();

        $request = [
            'filters' => [
                $filterName => $relationModels->pluck('id')->toArray()
            ]
        ];

        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModels->pluck('name')->toArray())
            ->assertDontSee($this->getModels()->pluck('name')->toArray());
    }
}
