<?php

use Domain\Shelf\Models\Collectible;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collectible::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('price_old')->nullable();
            $table->unsignedInteger('quantity')->default(1)->nullable();
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
                Schema::dropIfExists('sales');
        }
    }
};
