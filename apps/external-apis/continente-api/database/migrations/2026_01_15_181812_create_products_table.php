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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('external_id', 50)->unique();
            $table->string('name', 255);
            $table->string('category', 120)->nullable();
            $table->float('price_cents', 2);
            $table->char('currency', 3)->default('EUR');
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->index('name');
            $table->index('category');
            $table->index(['available', 'price_cents']);
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
