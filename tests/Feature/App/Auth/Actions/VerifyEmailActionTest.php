<?php

namespace App\Auth\Actions;

use Database\Factories\UserFactory;
use Domain\Auth\Actions\VerifyEmailAction;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VerifyEmailActionTest extends TestCase
{
    use RefreshDatabase;



    /**
     * @test
     * @return void
     */
    public function it_verification_notification_sent_success(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $action = app(VerifyEmailAction::class);

        $verificatedUser = $action($user->id);

        $this->assertNotNull($verificatedUser->email_verified_at);
    }

    /**
     * @test
     * @return void
     */
    public function it_verification_event_success(): void
    {
        Event::fake();

        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $action = app(VerifyEmailAction::class);

        $action($user->id);

        Event::assertDispatched(Verified::class);

    }
}
