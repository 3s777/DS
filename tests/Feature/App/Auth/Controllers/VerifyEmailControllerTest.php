<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\VerifyEmailAdminController;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Notifications\VerifyEmailAdminNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_success(): void
    {
        $this->get(action([VerifyEmailAdminController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.verify'))
            ->assertViewIs('content.auth.verify');
    }

    public function test_verification_notification_sent(): void
    {
        //        Queue::fake();

        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $this->post(action([VerifyEmailAdminController::class, 'sendVerifyNotification']), ['email' => $user->email])
            ->assertRedirectToRoute('admin.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verify_retry_send'));

        Notification::assertSentTo([$user], VerifyEmailAdminNotification::class);

        //        Queue::assertNothingPushed();
    }

    public function test_verification_notification_fail(): void
    {
        $user = UserFactory::new()->create();

        $this->post(action([VerifyEmailAdminController::class, 'sendVerifyNotification']), ['email' => $user->email])
            ->assertRedirectToRoute('admin.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verified'));

        Notification::assertNothingSent();
    }

    public function test_get_verify_confirmation_success(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'admin.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        $this->get($url)
            ->assertRedirectToRoute('search')
            ->assertSessionHas('helper_flash_message', __('auth.verified'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_get_wrong_email_verification_fail(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'admin.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1('testing@dustyshelf.space'),
            ]
        );

        $this->get($url)
            ->assertStatus(403);

        $this->assertGuest();
    }

    public function test_get_wrong_id_verification_fail(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $url = URL::temporarySignedRoute(
            'admin.verification.verify',
            now()->addMinutes(60),
            [
                'id' => '99999999999',
                'hash' => sha1($user->email),
            ]
        );

        $this->get($url)
            ->assertStatus(403);

        $this->assertGuest();
    }
}
