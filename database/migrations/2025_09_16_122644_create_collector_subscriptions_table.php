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
        Schema::create('collector_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')
                ->constrained('collectors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('target_collector_id')
                ->constrained('collectors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();

            $table->unique(['subscriber_id', 'target_collector_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
                Schema::dropIfExists('collector_subscriptions');
        }
    }
};
