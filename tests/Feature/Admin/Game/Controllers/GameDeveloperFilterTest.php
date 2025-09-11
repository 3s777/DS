<?php

namespace Admin\Game\Controllers;

use App\Admin\Http\Controllers\Game\GameDeveloperController;
use Database\Factories\Game\GameDeveloperFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;
use Tests\Traits\HasSorters;

class GameDeveloperFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Collection $gameDevelopers;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameDevelopers = GameDeveloperFactory::new()
            ->count(10)
            ->create();
    }

    public function getFactory(): Factory
    {
        return GameDeveloperFactory::new();
    }

    public function getAction(): array
    {
        return [GameDeveloperController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'developers';
    }

    public function getModels(): Collection
    {
        return $this->gameDevelopers;
    }

    public function test_success_search_filtered_response(): void
    {
        $this->searchFilter();
    }

    public function test_success_dates_from_filtered_response(): void
    {
        $this->datesFromFilter();
    }

    public function test_success_dates_to_filtered_response(): void
    {
        $this->datesToFilter();
    }


    public function test_success_dates_filtered_response(): void
    {
        $this->datesFilter();
    }

    public function test_success_user_filtered_response(): void
    {
        $this->userFilter();
    }

    public function test_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
                'user' => 'wrong_user'
             ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid(['filters.dates.from', 'filters.dates.to', 'filters.user'])
            ->assertRedirectToRoute('admin.game-developers.index');
    }

    public function test_success_sorted_response(): void
    {
        $this->checkSortOrder('id');
        $this->checkSortOrder('name');
        $this->checkSortOrder('created_at');
        $this->checkSortOrder('users.name', 'user.name', 'user->name');
    }
}
