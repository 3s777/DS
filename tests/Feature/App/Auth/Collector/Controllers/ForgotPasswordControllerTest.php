<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Collector\ForgotPasswordController;
use Database\Factories\CollectorFactory;
use Domain\Auth\Notifications\ResetPasswordCollectorNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function testingCredentials(): array
    {
        return [
            'email' => 'qqq@qq.qq',
        ];
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertViewIs('content.auth-collector.forgot-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {
        $collector = CollectorFactory::new()->create($this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('collector.forgot');

        Notification::assertSentTo([$collector], ResetPasswordCollectorNotification::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        $this->assertDatabaseMissing('collectors', $this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('collector.forgot');

        Notification::assertNothingSent();
    }
}
