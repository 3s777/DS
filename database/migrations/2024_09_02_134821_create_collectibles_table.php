<?php

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Category;
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
            $table->unsignedInteger('purchase_price')->nullable();
            $table->date('purchased_at')->nullable();
            $table->string('seller')->nullable();
            $table->string('additional_field')->nullable();
            $table->jsonb('kit_conditions')->nullable();
            $table->jsonb('properties')->nullable();
            $table->morphs('collectable');
            $table->string('target');
            $table->jsonb('sale')->nullable();
            $table->jsonb('auction')->nullable();
            $table->string('thumbnail')->nullable();
            $table->jsonb('images')->nullable();
            $table->jsonb('description')->nullable();
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
