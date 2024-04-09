<?php

namespace Support\Traits;

use App\Http\Controllers\Game\GameDeveloperController;
use App\Jobs\GenerateThumbnailJob;
use Carbon\Carbon;
use Database\Factories\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HasThumbnailTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_filtered_response(): void
    {
        Queue::fake();

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail',
            ['small', 'medium']
        );

        Queue::assertPushed(GenerateThumbnailJob::class);

        Storage::disk('images')->assertExists($gameDeveloper->thumbnail);



//        $this->actingAs($this->user)
//            ->get(action([GameDeveloperController::class, 'index'], $request))
//            ->assertOk()
//            ->assertViewHas('developers')
//            ->assertSee($expectedGameDeveloper->name)
//            ->assertDontSee($gameDevelopers->random()->first()->name);
    }

}
