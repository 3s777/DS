<?php

use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collectible_kit_item', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collectible::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(KitItem::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->smallInteger('condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('collectible_kit_item');
        }
    }
};
