<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\ShelfController;
use Database\Factories\Shelf\ShelfFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;
use Tests\Traits\HasSorters;

class ShelfFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Collection $shelves;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->shelves = ShelfFactory::new()
            ->count(10)
            ->create();
    }

    public function getFactory(): Factory
    {
        return ShelfFactory::new();
    }

    public function getAction(): array
    {
        return [ShelfController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'shelves';
    }

    public function getModels(): Collection
    {
        return $this->shelves;
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_filtered_response(): void
    {
        $this->searchFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_from_filtered_response(): void
    {
        $this->datesFromFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_to_filtered_response(): void
    {
        $this->datesToFilter();
    }


    /**
     * @test
     * @return void
     */
    public function it_success_dates_filtered_response(): void
    {
        $this->datesFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_user_filtered_response(): void
    {
        $this->userFilter('collector', 'collector_id', Collector::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
                'collector' => 'wrong_user'
             ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid(['filters.dates.from', 'filters.dates.to', 'filters.collector'])
            ->assertRedirectToRoute('admin.shelves.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sorted_response(): void
    {
        $this->checkSortOrder('id');
        $this->checkSortOrder('name');
        $this->checkSortOrder('created_at');
        $this->checkSortOrder('collectors.name', 'collector.name', 'collector->name');
    }
}
