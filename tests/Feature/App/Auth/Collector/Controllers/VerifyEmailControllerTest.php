<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Public\Collector\VerifyEmailController;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Notifications\VerifyEmailCollectorNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_success(): void
    {
        $this->get(action([VerifyEmailController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.verify'))
            ->assertViewIs('content.auth-collector.verify');
    }

    public function test_verification_notification_sent(): void
    {
        //        Queue::fake();

        $request = [
            'email_verified_at' => null
        ];

        $collector = CollectorFactory::new()->create($request);

        $this->post(action([VerifyEmailController::class, 'sendVerifyNotification']), ['email' => $collector->email])
            ->assertRedirectToRoute('collector.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verify_retry_send'));

        Notification::assertSentTo([$collector], VerifyEmailCollectorNotification::class);
    }

    public function test_verification_notification_fail(): void
    {
        $collector = CollectorFactory::new()->create();

        $this->post(action([VerifyEmailController::class, 'sendVerifyNotification']), ['email' => $collector->email])
            ->assertRedirectToRoute('collector.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verified'));

        Notification::assertNothingSent();
    }

    public function test_get_verify_confirmation_success(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $collector = CollectorFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'collector.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $collector->id,
                'hash' => sha1($collector->email),
            ]
        );

        $this->get($url)
            ->assertRedirectToRoute('search')
            ->assertSessionHas('helper_flash_message', __('auth.verified'));

        $this->assertAuthenticatedAs($collector);
    }

    public function test_get_wrong_email_verification_fail(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $collector = CollectorFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'collector.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $collector->id,
                'hash' => sha1('testing@dustyshelf.space'),
            ]
        );

        $this->get($url)
            ->assertStatus(403);

        $this->assertGuest('collector');
    }

    public function test_get_wrong_id_verification_fail(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $collector = CollectorFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'collector.verification.verify',
            now()->addMinutes(60),
            [
                'id' => '99999999999',
                'hash' => sha1($collector->email),
            ]
        );

        $this->get($url)
            ->assertStatus(403);

        $this->assertGuest('collector');
    }
}
