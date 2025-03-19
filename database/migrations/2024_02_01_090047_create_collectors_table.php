<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collectors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_banned')->nullable();
            $table->string('language')->default('en');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('collectors');
        }
    }
};
