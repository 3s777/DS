<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\VerifyEmailNotification;
use Database\Factories\LanguageFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
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
            ->assertRedirect(route('verification.notice'))
            ->assertSessionHas('helper_flash_message', 'We retry send verification link to your email');

        Notification::assertSentTo([$user], VerifyEmailNotification::class);

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
            ->assertRedirect(route('verification.notice'))
            ->assertSessionHas('helper_flash_message', 'Your email is verified');

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
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        $this->get($url)
            ->assertRedirect(route('search'))
            ->assertSessionHas('helper_flash_message', 'Your email is verified');

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
            'verification.verify',
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
            'verification.verify',
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
