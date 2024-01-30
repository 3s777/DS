<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Language;
use Database\Factories\LanguageFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Actions\LoginUserAction;
use Domain\Auth\DTOs\LoginUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_page_search_success(): void
    {
        $this->get(route('search'))
            ->assertOk()
            ->assertSee('Результаты поиска')
            ->assertViewIs('content.search.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_page_feed_success(): void
    {
        $this->get(route('feed'))
            ->assertOk()
            ->assertSee('BLES00789')
            ->assertViewIs('content.feed.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_page_users_success(): void
    {
        $this->get(route('users'))
            ->assertOk()
            ->assertSee('Список пользователей')
            ->assertViewIs('content.users.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_page_game_carrier_success(): void
    {
        $this->get(route('game-carrier'))
            ->assertOk()
            ->assertSee('Resonance of Fate')
            ->assertViewIs('content.game-carrier.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_page_ui_success(): void
    {
        $this->get(route('ui'))
            ->assertOk()
            ->assertSee('UI examples')
            ->assertViewIs('content.ui.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_page_qa_success(): void
    {
        $this->get(route('qa'))
            ->assertOk()
            ->assertSee('Вопрос-ответ')
            ->assertViewIs('content.page.qa');
    }
}
