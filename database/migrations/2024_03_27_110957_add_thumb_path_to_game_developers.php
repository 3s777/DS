<?php

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
        Schema::table('game_developers', function (Blueprint $table) {
            $table->string('thumb_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
            Schema::table('game_developers', function (Blueprint $table) {
                $table->dropColumn(['thumb_path']);
            });
        }
    }
};
