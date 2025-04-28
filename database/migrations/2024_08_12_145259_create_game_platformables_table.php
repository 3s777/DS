<?php

use Domain\Game\Models\GamePlatform;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_platformables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(GamePlatform::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->morphs('game_platformable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('game_platformables');
        }
    }
};
