<?php

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->jsonb('description')->nullable();
            $table->string('type')->default('stationary')->nullable();
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(GamePlatformManufacturer::class)->nullable();
            $table->string('featured_image')->nullable();

            $table->softDeletes();
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
