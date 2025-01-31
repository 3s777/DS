<?php

use Domain\Auth\Models\User;
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
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->string('name');
            $table->integer('number')->nullable();
            $table->string('featured_image')->nullable();
            $table->jsonb('description')->nullable();
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
                Schema::dropIfExists('shelves');
        }
    }
};
