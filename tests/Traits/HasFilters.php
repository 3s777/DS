<?php

namespace Tests\Traits;

use Carbon\Carbon;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

trait HasFilters
{
    abstract public function getFactory(): Factory;
    abstract public function getAction(): array;
    abstract public function getUser(): User;
    abstract public function getViewData(): string;

    abstract public function getModels(): Collection;

    public function searchFilter(string $filterName = 'search'): void
    {
        $expectedModel = $this->getFactory()
            ->create(['name' => 'search test']);


        $request = [
            'filters' => [
                $filterName => 'test'
            ]
        ];


        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($this->getModels()->random()->first()->name);
    }

    public function datesFilter(string $filterName = 'dates', string $field = 'created_at'): void
    {
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

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($this->getModels()->random()->first()->name);
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

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($models->random()->first()->name);
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

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($models->random()->first()->name);
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

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModel->name)
            ->assertDontSee($this->getModels()->random()->first()->name);
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
