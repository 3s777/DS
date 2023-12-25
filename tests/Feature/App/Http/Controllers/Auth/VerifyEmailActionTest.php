<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Notifications\ResetPasswordNotification;
use Database\Factories\UserFactory;

use Domain\Auth\Actions\VerifyEmailAction;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailActionTest extends TestCase
{
    use RefreshDatabase;



    /**
     * @test
     * @return void
     */
    public function it_verification_notification_sent(): void
    {
        $request = [
            'email_verified_at' => null
        ];

        $user = UserFactory::new()->create($request);

        $action = app(VerifyEmailAction::class, [$user->id]);

        $action(['id' => $user->id]);

        $this->assertNotNull($user->email_verified_at);
    }
}
