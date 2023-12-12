<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

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
    public function it_login_page_success(): void
    {
        URL::defaults(['locale' => 'ru']);

        $this->get(action([AuthController::class, 'login']))
            ->assertOk()
            ->assertSee('Войти')
            ->assertViewIs('content.auth.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_up_page_success(): void
    {
        URL::defaults(['locale' => 'ru']);

        $this->get(action([AuthController::class, 'register']))
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('content.auth.register');
    }

    /**
     * @test
     * @return void
     */
    public function it_forgot_page_success(): void
    {
        URL::defaults(['locale' => 'ru']);

        $this->get(action([AuthController::class, 'forgot']))
            ->assertOk()
            ->assertSee('Забыли')
            ->assertViewIs('content.auth.forgot-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_in_page_success(): void
    {
        URL::defaults(['locale' => 'ru']);

        $password = '123456789q';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $request = SignInRequest::factory()->create([
            'username' => $user->email,
            'password' => $password
        ]);

       $response = $this->post(action([AuthController::class, 'signIn']), $request);

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
        URL::defaults(['locale' => 'ru']);

        $user = User::factory()->create([]);

        $this->actingAs($user)->delete(action([AuthController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        Notification::fake();
        Event::fake();

        $this->app->setLocale('ru');

        URL::defaults(['locale' => 'ru']);

        $request = SignUpRequest::factory()->create([
            'password' => '123456789q',
            'password_confirmation' => '123456789q'
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $request['email']
        ]);



        $response = $this->post(
            action([AuthController::class, 'signUp']),
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

//        Notification::assertSentTo($user, VerifyEmailNotification::class);

        $response->assertRedirect(route('login'));
    }
}
