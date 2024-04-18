<?php

namespace Support\Actions;

use Database\Factories\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Actions\LoginUserAction;
use Domain\Auth\DTOs\LoginUserDTO;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\DTOs\MassDeletingDTO;
use Tests\TestCase;

class MassDeletingActionTest extends TestCase
{
    use RefreshDatabase;

    public string $modelsIds;
    public GameDeveloper $models;

    protected function setUp(): void
    {
        parent::setUp();

        $this->models = GameDeveloperFactory::new()->count(5)->create();
        $modelsIdsArray = $this->models->pluck('id')->all();
        $this->modelsIds = implode(',', $modelsIdsArray);

//        $this->user = UserFactory::new()->create([
//            'password' => bcrypt($this->password),
//            'remember_token' => null
//        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_mass_deleting_success(): void
    {


        $action = app(MassDeletingAction::class);

        $action(MassDeletingDTO::make(
            'Domain\Game\Models\GameDeveloper',
            $this->modelsIds));

        $this->assertDatabaseCount('game_developers', 5);

        foreach($this->models as $model) {
            $this->assertModelExists($model);
            $this->assertSoftDeleted($model);
        }
    }

    /**
     * @test
     * @return void
     */
    public function it_mass_force_deleting_success(): void
    {

        $action = app(MassDeletingAction::class);

        $action(MassDeletingDTO::make(
            'Domain\Game\Models\GameDeveloper',
            $this->modelsIds,
            true));

        $this->assertDatabaseCount('game_developers', 0);

        foreach($this->models as $model) {
            $this->assertModelMissing($model);

            $this->assertDatabaseMissing('game_developers', [
                'id' => $model->id,
            ]);
        }
    }
}
