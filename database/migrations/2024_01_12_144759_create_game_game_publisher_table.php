<?php

use Domain\Game\Models\Game;
use Domain\Game\Models\Publisher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_game_publisher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id');
            $table->foreignId('game_publisher_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
            Schema::dropIfExists('game_game_publisher');
        }
    }
};
