<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GameMediaController;
use App\Http\Controllers\Game\Admin\GameMediaVariationController;
use Database\Factories\Game\GameMediaVariationFactory;
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

class GameMediaVariationFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Collection $gameMediaVariations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameMediaVariations = GameMediaVariationFactory::new()
            ->count(10)
            ->create();
    }

    public function getFactory(): Factory
    {
        return GameMediaVariationFactory::new();
    }

    public function getAction(): array
    {
        return [GameMediaVariationController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'gameMediaVariations';
    }

    public function getModels(): Collection
    {
        return $this->gameMediaVariations;
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
        $this->userFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_is_main_filtered_response(): void
    {
        $this->booleanFilter('is_main', 'is_main');
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
                'search' => ['wrong_data'],
                'is_main' => ['wrong_data']
            ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid([
                'filters.dates.from',
                'filters.dates.to',
                'filters.user',
                'filters.search',
                'filters.is_main'
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
        $this->checkSortOrder('is_main');
        $this->checkSortOrder('users.name', 'user.name', 'user->name');
    }
}
