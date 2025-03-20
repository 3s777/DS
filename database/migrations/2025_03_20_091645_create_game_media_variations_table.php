<?php

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
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
        Schema::create('game_media_variations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('article_number')->nullable();
            $table->text('barcodes')->nullable();
            $table->text('alternative_names')->nullable()->index();
            $table->jsonb('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('images')->nullable();
            $table->string('region')->nullable();
            $table->boolean('is_main')->default(false)->nullable();
            $table->foreignIdFor(GameMedia::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
            Schema::dropIfExists('game_media_variations');
        }
    }
};
