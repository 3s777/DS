<?php

use Domain\Auth\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->json('alternative_names')->nullable();
            $table->date('released_at')->nullable();
            $table->jsonb('description')->nullable();
            $table->string('thumbnail')->nullable();
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
        if (! app()->isProduction()) {
            Schema::dropIfExists('games');
        }
    }
};
