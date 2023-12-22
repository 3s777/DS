<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\VerifyEmailNotification;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;



    /**
     * @test
     * @return void
     */
    public function it_sign_in_page_success(): void
    {
        $password = '123456789q';

        $user = UserFactory::new()->create([
            'password' => bcrypt($password)
        ]);

        $request = [
            'email' => $user->email,
            'password' => $password
        ];

       $response = $this->post(action([LoginController::class, 'handle']), $request);

       $response->assertValid()
           ->assertRedirect(route('search'));

       $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create([]);

        $this->actingAs($user)->delete(action([LoginController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_up_success(): void
    {
        Notification::fake();
        Event::fake();

        $this->app->setLocale('ru');

        $request = RegisterRequest::factory()->create([
            'password' => '123456789q',
            'password_confirmation' => '123456789q'
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $request['email']
        ]);

        $response = $this->post(
            action([RegisterController::class, 'handle']),
            $request
        );

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $request['email']
        ]);

        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailVerificationNotification::class);

        $event = new Registered($user);

        $listener = new SendEmailVerificationNotification();
        $listener->handle($event);

        Notification::assertSentTo($user, VerifyEmail::class);


        $response->assertRedirect(route('login'));
    }
}
