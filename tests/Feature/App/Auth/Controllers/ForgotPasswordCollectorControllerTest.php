<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordCollectorController;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Notifications\ResetPasswordCollectorNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordCollectorControllerTest extends TestCase
{
    use RefreshDatabase;

    private function testingCredentials(): array
    {
        return [
            'email' => 'qqq@qq.qq',
        ];
    }

    public function test_page_success(): void
    {
        $this->get(action([ForgotPasswordCollectorController::class, 'page']))
            ->assertOk()
            ->assertViewIs('content.auth-collector.forgot-password');
    }

    public function test_handle_success(): void
    {
        $collector = CollectorFactory::new()->create($this->testingCredentials());

        $this->post(action([ForgotPasswordCollectorController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('collector.forgot');

        Notification::assertSentTo([$collector], ResetPasswordCollectorNotification::class);
    }

    public function test_handle_fail(): void
    {
        $this->assertDatabaseMissing('collectors', $this->testingCredentials());

        $this->post(action([ForgotPasswordCollectorController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('collector.forgot');

        Notification::assertNothingSent();
    }
}
