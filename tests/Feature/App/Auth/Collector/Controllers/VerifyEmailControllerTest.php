<?php

namespace App\Auth\Admin\Controllers;

use App\Http\Controllers\Auth\Admin\VerifyEmailController;
use Database\Factories\UserFactory;
use Domain\Auth\Notifications\VerifyEmailAdminNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([VerifyEmailController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.verify'))
            ->assertViewIs('content.auth.verify');
    }

    /**
     * @test
     * @return void
     */
    public function it_verification_notification_sent(): void
    {
        //        Queue::fake();

        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $this->post(action([VerifyEmailController::class, 'sendVerifyNotification']), ['email' => $user->email])
            ->assertRedirectToRoute('admin.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verify_retry_send'));

        Notification::assertSentTo([$user], VerifyEmailAdminNotification::class);

        //        Queue::assertNothingPushed();
    }

    /**
     * @test
     * @return void
     */
    public function it_verification_notification_fail(): void
    {
        $user = UserFactory::new()->create();

        $this->post(action([VerifyEmailController::class, 'sendVerifyNotification']), ['email' => $user->email])
            ->assertRedirectToRoute('admin.verification.notice')
            ->assertSessionHas('helper_flash_message', __('auth.verified'));

        Notification::assertNothingSent();
    }

    /**
     * @test
     * @return void
     */
    public function it_get_verify_confirmation_success(): void
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

    /**
     * @test
     * @return void
     */
    public function it_get_wrong_email_verification_fail(): void
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

    /**
     * @test
     * @return void
     */
    public function it_get_wrong_id_verification_fail(): void
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
