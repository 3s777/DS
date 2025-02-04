<?php

namespace App\Game\Services;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Game\Admin\CreateGameMediaRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Game\DTOs\FillGameMediaDTO;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Game\Services\GameMediaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameMediaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameMediaRequest::factory()->create();

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

        $this->assertDatabaseMissing('game_medias', [
            'name' => $this->request['name']
        ]);

        $this->request['user_id'] = $this->user->id;
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $request = new Request($this->request);

        $gameService = app(GameMediaService::class);

        $gameService->create(FillGameMediaDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('game_medias', [
            'name' => $this->request['name']
        ]);

        $gameMedia = GameMedia::where('name', $this->request['name'])->first();

        foreach($this->request['games'] as $game) {
            $this->assertTrue($gameMedia->games->contains($game));
        }

        foreach($this->request['developers'] as $developer) {
            $this->assertTrue($gameMedia->developers->contains($developer));
        }

        foreach($this->request['publishers'] as $publisher) {
            $this->assertTrue($gameMedia->publishers->contains($publisher));
        }

        foreach($this->request['genres'] as $genre) {
            $this->assertTrue($gameMedia->genres->contains($genre));
        }

        foreach($this->request['platforms'] as $platform) {
            $this->assertTrue($gameMedia->platforms->contains($platform));
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

        $gameMediaService = app(GameMediaService::class);

        $gameMediaService->create(FillGameMediaDTO::fromRequest(
            $createRequest
        ));

        $gameMedia = GameMedia::where('name', $this->request['name'])->first();

        $newGames = Game::factory(2)->create();
        $newDevelopers = GameDeveloper::factory(2)->create();
        $newPublishers = GamePublisher::factory(2)->create();
        $newGenres = GameGenre::factory(2)->create();
        $newPlatforms = GamePlatform::factory(2)->create();

        $this->request['name'] = 'NewNameGameMedia';
        $this->request['slug'] = 'newslug';
        $this->request['description'] = 'NewDescription';
        $this->request['released_at'] = fake()->date();
        $this->request['games'] = $newGames->pluck('id')->toArray();
        $this->request['developers'] = $newDevelopers->pluck('id')->toArray();
        $this->request['publishers'] = $newPublishers->pluck('id')->toArray();
        $this->request['genres'] = $newGenres->pluck('id')->toArray();
        $this->request['platforms'] = $newPlatforms->pluck('id')->toArray();
        $this->request['featured_image'] = UploadedFile::fake()->image('photo2.jpg');

        $updateRequest = new CreateAdminRequest($this->request);

        $gameMediaService->update($gameMedia, FillGameMediaDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('game_medias', [
            'name' => 'NewNameGameMedia',
        ]);

        $updatedGameMedia= GameMedia::where('name', 'NewNameGameMedia')->first();

        $this->assertTrue($updatedGameMedia->slug == $this->request['slug']);
        $this->assertTrue($updatedGameMedia->released_at == $this->request['released_at']);
        $this->assertTrue($updatedGameMedia->description == $this->request['description']);

        foreach($this->request['games'] as $game) {
            $this->assertTrue($updatedGameMedia->games->contains($game));
        }

        foreach($this->request['developers'] as $developer) {
            $this->assertTrue($updatedGameMedia->developers->contains($developer));
        }

        foreach($this->request['publishers'] as $publisher) {
            $this->assertTrue($updatedGameMedia->publishers->contains($publisher));
        }

        foreach($this->request['genres'] as $genre) {
            $this->assertTrue($updatedGameMedia->genres->contains($genre));
        }

        foreach($this->request['platforms'] as $platform) {
            $this->assertTrue($updatedGameMedia->platforms->contains($platform));
        }

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
