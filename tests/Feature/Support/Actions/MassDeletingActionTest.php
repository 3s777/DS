<?php

namespace Support\Actions;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Support\DTOs\MassDeletingDTO;
use Tests\TestCase;

class MassDeletingActionTest extends TestCase
{
    use RefreshDatabase;

    public string $modelsIds;
    public Collection $models;

    protected function setUp(): void
    {
        parent::setUp();

        $this->models = GameDeveloper::factory()
            ->for(User::factory()->create())
            ->count(5)
            ->create();
        $modelsIdsArray = $this->models->pluck('id')->toArray();
        $this->modelsIds = implode(',', $modelsIdsArray);
    }

    public function test_mass_deleting_success(): void
    {
        $action = app(MassDeletingAction::class);

        $action(MassDeletingDTO::make(
            'Domain\Game\Models\GameDeveloper',
            $this->modelsIds
        ));

        $this->assertDatabaseCount('game_developers', 5);

        foreach ($this->models as $model) {
            $this->assertModelExists($model);
            $this->assertSoftDeleted($model);
        }
    }

    public function test_mass_force_deleting_success(): void
    {
        $undeletedModels = GameDeveloper::factory()
            ->for(User::factory()->create())
            ->count(2)
            ->create();

        $action = app(MassDeletingAction::class);

        $action(MassDeletingDTO::make(
            'Domain\Game\Models\GameDeveloper',
            $this->modelsIds,
            true
        ));

        $this->assertDatabaseCount('game_developers', 2);

        foreach ($undeletedModels as $model) {
            $this->assertModelExists($model);

            $this->assertDatabaseHas('game_developers', [
                'id' => $model->id,
            ]);
        }

        foreach ($this->models as $model) {
            $this->assertModelMissing($model);

            $this->assertDatabaseMissing('game_developers', [
                'id' => $model->id,
            ]);
        }
    }
}
