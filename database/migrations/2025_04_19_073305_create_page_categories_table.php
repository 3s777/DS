<?php

use Domain\Page\Models\PageCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Domain\Auth\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_categories', function (Blueprint $table) {
            $table->id();
            $table->jsonb('name');
            $table->string('slug')->unique();
            $table->foreignIdFor(PageCategory::class, 'parent_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->jsonb('description')->nullable();
            $table->foreignIdFor(User::class)
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if(!app()->isProduction()) {
            Schema::dropIfExists('page_categories');
        }
    }
};
