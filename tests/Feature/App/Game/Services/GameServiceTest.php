<?php

namespace App\Game\Services;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Game\Admin\CreateGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Game\DTOs\FillGameDTO;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Game\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_game_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('games', [
            'name' => $this->request['name']
        ]);

        $this->request['user_id'] = $this->user->id;
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $request = new Request($this->request);

        $gameService = app(GameService::class);

        $gameService->create(FillGameDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('games', [
            'name' => $this->request['name']
        ]);

        $game = Game::where('name', $this->request['name'])->first();

        foreach ($this->request['developers'] as $developer) {
            $this->assertTrue($game->developers->contains($developer));
        }

        foreach ($this->request['publishers'] as $publisher) {
            $this->assertTrue($game->publishers->contains($publisher));
        }

        foreach ($this->request['genres'] as $genre) {
            $this->assertTrue($game->genres->contains($genre));
        }

        foreach ($this->request['platforms'] as $platform) {
            $this->assertTrue($game->platforms->contains($platform));
        }

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }


    /**
     * @test
     * @return void
     */
    public function it_game_updated_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['user_id'] = $this->user->id;

        $createRequest = new Request($this->request);

        $gameService = app(GameService::class);

        $gameService->create(FillGameDTO::fromRequest(
            $createRequest
        ));

        $game = Game::where('name', $this->request['name'])->first();

        $newDevelopers = GameDeveloper::factory(2)->create();
        $newPublishers = GamePublisher::factory(2)->create();
        $newGenres = GameGenre::factory(2)->create();
        $newPlatforms = GamePlatform::factory(2)->create();

        $this->request['name'] = 'NewNameGame';
        $this->request['slug'] = 'newslug';
        $this->request['description'] = 'NewDescription';
        $this->request['released_at'] = fake()->date();
        $this->request['developers'] = $newDevelopers->pluck('id')->toArray();
        $this->request['publishers'] = $newPublishers->pluck('id')->toArray();
        $this->request['genres'] = $newGenres->pluck('id')->toArray();
        $this->request['platforms'] = $newPlatforms->pluck('id')->toArray();
        $this->request['featured_image'] = UploadedFile::fake()->image('photo2.jpg');

        $updateRequest = new CreateAdminRequest($this->request);

        $gameService->update($game, FillGameDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('games', [
            'name' => 'NewNameGame',
        ]);

        $updatedGame = Game::where('name', 'NewNameGame')->first();

        $this->assertSame($updatedGame->slug, $this->request['slug']);
        $this->assertSame($updatedGame->released_at->format('Y-m-d'), $this->request['released_at']);
        $this->assertSame($updatedGame->description, $this->request['description']);

        foreach ($this->request['developers'] as $developer) {
            $this->assertTrue($updatedGame->developers->contains($developer));
        }

        foreach ($this->request['publishers'] as $publisher) {
            $this->assertTrue($updatedGame->publishers->contains($publisher));
        }

        foreach ($this->request['genres'] as $genre) {
            $this->assertTrue($updatedGame->genres->contains($genre));
        }

        foreach ($this->request['platforms'] as $platform) {
            $this->assertTrue($updatedGame->platforms->contains($platform));
        }

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
