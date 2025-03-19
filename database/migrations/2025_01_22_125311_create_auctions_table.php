<?php

use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collectible::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Country::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('step');
            $table->datetime('finished_at');
            $table->unsignedBigInteger('blitz')->nullable();
            $table->smallInteger('renewal')->nullable();
            $table->string('shipping');
            $table->boolean('self_delivery')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('auctions');
        }
    }
};
