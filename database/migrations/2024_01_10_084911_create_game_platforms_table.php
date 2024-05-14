<?php

use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePlatformType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(GamePlatformManufacturer::class)->nullable();
            $table->foreignIdFor(GamePlatformType::class)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! app()->isProduction()) {
            Schema::dropIfExists('game_platforms');
        }
    }
};
