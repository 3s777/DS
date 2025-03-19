<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GameMediaController;
use Database\Factories\Game\GameMediaFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;
use Tests\Traits\HasSorters;

class GameMediaFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Collection $gameMedias;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameMedias = GameMediaFactory::new()
            ->count(10)
            ->create();
    }

    public function getFactory(): Factory
    {
        return GameMediaFactory::new();
    }

    public function getAction(): array
    {
        return [GameMediaController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'gameMedias';
    }

    public function getModels(): Collection
    {
        return $this->gameMedias;
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
    public function it_success_released_at_from_filtered_response(): void
    {
        $this->datesFromFilter('released_at', 'released_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_released_at_to_filtered_response(): void
    {
        $this->datesToFilter('released_at', 'released_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_released_at_filtered_response(): void
    {
        $this->datesFilter('released_at', 'released_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_user_filtered_response(): void
    {
        $this->userFilter();
    }


    /**
     * @test
     * @return void
     */
    public function it_success_genres_filtered_response(): void
    {
        $this->relationFilter('genres', GameGenre::class, 'genres');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_platforms_filtered_response(): void
    {
        $this->relationFilter('platforms', GamePlatform::class, 'platforms');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_developers_filtered_response(): void
    {
        $this->relationFilter('developers', GameDeveloper::class, 'developers');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_publishers_filtered_response(): void
    {
        $this->relationFilter('publishers', GamePublisher::class, 'publishers');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_games_filtered_response(): void
    {
        $this->relationFilter('games', Game::class, 'games');
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
                'user' => 'wrong_user',
                'genres' => 'wrong_data',
                'platforms' => 'wrong_data',
                'publishers' => 'wrong_data',
                'developers' => 'wrong_data',
                'games' => 'wrong_data'
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
                'filters.games'
            ])
            ->assertRedirectToRoute('admin.game-medias.index');
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
        $this->checkSortOrder('users.name', 'user.name', 'user->name');
    }
}
