<?php

namespace App\Auth\Collector\Actions;

use Database\Factories\CollectorFactory;
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

        $collector = CollectorFactory::new()->create($request);

        $action = app(VerifyEmailAction::class);

        $verificatedCollector = $action($collector);

        $this->assertNotNull($verificatedCollector->email_verified_at);
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

        $collector = CollectorFactory::new()->create($request);

        $action = app(VerifyEmailAction::class);

        $action($collector);

        Event::assertDispatched(Verified::class);

    }
}
