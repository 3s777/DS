<?php

namespace App\Auth\Admin\Controllers;

use App\Http\Controllers\Auth\Admin\AdminController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;

class AdminFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;

    protected User $user;
    protected Collection $users;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->users = UserFactory::new()
            ->count(8)
            ->create();
    }

    public function getFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getAction(): array
    {
        return [AdminController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'users';
    }

    public function getModels(): Collection
    {
        return $this->users;
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
    public function it_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
             ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid(['filters.dates.from', 'filters.dates.to'])
            ->assertRedirectToRoute('admin.users.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sorted_response(): void
    {
        $request = [
            'sort' => 'id'
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertSeeInOrder(
                $this->getModels()->sortBy('id')
                    ->flatMap(fn ($item) => [$item->id])
                    ->toArray()
            );

        $request = [
            'sort' => 'name'
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertSeeInOrder(
                $this->getModels()->sortBy('name')
                    ->flatMap(fn ($item) => [$item->name])
                    ->toArray()
            );

        $request = [
            'sort' => 'created_at'
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertSeeInOrder(
                $this->getModels()->sortBy('created_at')
                    ->flatMap(fn ($item) => [$item->created_at])
                    ->toArray()
            );
    }
}
