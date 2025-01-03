<?php

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Category;
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
        Schema::create('game_medias', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('article_number')->nullable();
            $table->text('barcodes')->nullable();
            $table->text('alternative_names')->nullable();
            $table->date('released_at')->nullable();
            $table->jsonb('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->foreignIdFor(User::class)
                ->constrained();

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
                Schema::dropIfExists('game_media');
        }
    }
};
