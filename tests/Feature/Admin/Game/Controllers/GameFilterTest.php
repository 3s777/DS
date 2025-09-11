<?php

namespace Admin\Game\Controllers;

use App\Admin\Http\Controllers\Game\GameController;
use Database\Factories\Game\GameFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;
use Tests\Traits\HasSorters;

class GameFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Collection $games;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->games = GameFactory::new()
            ->count(10)
            ->create();
    }

    public function getFactory(): Factory
    {
        return GameFactory::new();
    }

    public function getAction(): array
    {
        return [GameController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'games';
    }

    public function getModels(): Collection
    {
        return $this->games;
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

    public function test_success_released_at_from_filtered_response(): void
    {
        $this->datesFromFilter('released_at', 'released_at');
    }

    public function test_success_released_at_to_filtered_response(): void
    {
        $this->datesToFilter('released_at', 'released_at');
    }

    public function test_success_released_at_filtered_response(): void
    {
        $this->datesFilter('released_at', 'released_at');
    }

    public function test_success_user_filtered_response(): void
    {
        $this->userFilter();
    }



    public function test_success_genres_filtered_response(): void
    {
        $this->relationFilter('genres', GameGenre::class, 'genres');
    }

    public function test_success_platforms_filtered_response(): void
    {
        $this->relationFilter('platforms', GamePlatform::class, 'platforms');
    }

    public function test_success_developers_filtered_response(): void
    {
        $this->relationFilter('developers', GameDeveloper::class, 'developers');
    }

    public function test_success_publishers_filtered_response(): void
    {
        $this->relationFilter('publishers', GamePublisher::class, 'publishers');
    }

    public function test_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
                'user' => 'wrong_user',
                'genres' => 'wrong_data',
                'platforms' => 'wrong_data',
                'publishers' => 'wrong_data',
                'developers' => 'wrong_data'
             ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid([
                'filters.dates.from',
                'filters.dates.to',
                'filters.user',
                'filters.genres',
                'filters.platforms',
                'filters.publishers',
                'filters.developers',
                ])
            ->assertRedirectToRoute('admin.games.index');
    }

    public function test_success_sorted_response(): void
    {
        $this->checkSortOrder('id');
        $this->checkSortOrder('name');
        $this->checkSortOrder('created_at');
        $this->checkSortOrder('users.name', 'user.name', 'user->name');
    }
}
