<?php

namespace App\Game\Services;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Game\Admin\CreateGameMediaVariationRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\Services\GameMediaVariationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameMediaVariationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateGameMediaVariationRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_game_media_variation_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('game_media_variations', [
            'name' => $this->request['name']
        ]);

        $this->request['user_id'] = $this->user->id;
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $request = new Request($this->request);

        $gameMediaService = app(GameMediaVariationService::class);

        $gameMediaService->create(FillGameMediaVariationDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('game_media_variations', [
            'name' => $this->request['name']
        ]);

        $gameMediaVariation = GameMediaVariation::where('name', $this->request['name'])->first();


        $this->assertSame($gameMediaVariation->gameMedia->id, $this->request['game_media_id']);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }


    /**
     * @test
     * @return void
     */
    public function it_game_media_variation_updated_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['user_id'] = $this->user->id;

        $createRequest = new Request($this->request);

        $gameMediaVariationService = app(GameMediaVariationService::class);

        $gameMediaVariationService->create(FillGameMediaVariationDTO::fromRequest(
            $createRequest
        ));

        $gameMediaVariation = GameMediaVariation::where('name', $this->request['name'])->first();

        $newGameMedia = GameMedia::factory()->create();

        $this->request['name'] = 'NewNameGameMediaVariation';
        $this->request['slug'] = 'newslug';
        $this->request['description'] = 'NewDescription';
        $this->request['barcodes'] = 'new-barcode||new-barcode-2';
        $this->request['game_media_id'] =  $newGameMedia->id;
        $this->request['featured_image'] = UploadedFile::fake()->image('photo2.jpg');

        $updateRequest = new CreateGameMediaVariationRequest($this->request);

        $gameMediaVariationService->update($gameMediaVariation, FillGameMediaVariationDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('game_media_variations', [
            'name' => 'NewNameGameMediaVariation',
        ]);

        $updatedGameMediaVariation = GameMediaVariation::where('name', 'NewNameGameMediaVariation')->first();

        $this->assertSame($updatedGameMediaVariation->slug, $this->request['slug']);
        $this->assertSame($updatedGameMediaVariation->description, $this->request['description']);
        $this->assertSame($updatedGameMediaVariation->barcodes, explode('||',$this->request['barcodes']));
        $this->assertSame($updatedGameMediaVariation->gameMedia->id, $this->request['game_media_id']);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_game_media_variation_main_updated_success(): void
    {
        $gameMedia = GameMedia::factory()->create();

        $gameVariation = GameMediaVariation::factory()->create([
            'is_main' => false,
            'game_media_id' => $gameMedia->id
        ]);

        GameMediaVariation::factory(3)->create([
            'is_main' => false,
            'game_media_id' => $gameMedia->id
        ]);

        $mainGameVariation = GameMediaVariation::factory()->create([
            'is_main' => true,
            'game_media_id' => $gameMedia->id
        ]);

        $this->request['user_id'] = $this->user->id;
        $this->request['is_main'] = true;
        $this->request['game_media_id'] = $gameMedia->id;

        $updateRequest = new Request($this->request);

        $gameMediaVariationService = app(GameMediaVariationService::class);

        $gameMediaVariationService->update($gameVariation, FillGameMediaVariationDTO::fromRequest($updateRequest));

        $this->assertTrue($gameVariation->is_main);
        $this->assertFalse($mainGameVariation->refresh()->is_main);
    }
}
