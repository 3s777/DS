<?php

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Shelf;
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
        Schema::create('collectibles', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('article_number')->nullable();
            $table->string('condition');
            $table->foreignIdFor(Shelf::class)->constrained();
            $table->jsonb('kit')->nullable();
            $table->jsonb('properties')->nullable();
            $table->morphs('collectable');
            $table->string('thumbnail')->nullable();
            $table->jsonb('description')->nullable();
            $table->foreignIdFor(User::class)->constrained();

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
            Schema::dropIfExists('collectibles');
        }
    }
};
