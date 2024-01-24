<?php

namespace Tests;

use App\Models\Language;
use Database\Factories\LanguageFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        Http::preventStrayRequests();

        URL::defaults(['locale' => 'ru']);
    }
}
