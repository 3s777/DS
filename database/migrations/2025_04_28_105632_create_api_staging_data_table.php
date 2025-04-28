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
        Schema::create('api_staging_data', function (Blueprint $table) {
            $table->id();
            $table->jsonb('data');
            $table->string('data_id')->nullable();
            $table->string('data_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
                Schema::dropIfExists('api_staging_data');
        }
    }
};
