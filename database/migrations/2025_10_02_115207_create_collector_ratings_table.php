<?php

use Domain\Auth\Models\Collector;
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
        Schema::create('collector_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collector::class)
                ->constrained('collectors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('rater_id')
                ->constrained('collectors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->smallInteger('rating');
            $table->text('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['collector_id', 'rater_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!app()->isProduction()) {
            Schema::dropIfExists('collector_ratings');
        }
    }
};
