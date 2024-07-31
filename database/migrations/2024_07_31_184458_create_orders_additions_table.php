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
        Schema::create('orders_additions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_addition')->constrained('additions');
            $table->foreignId('id_order')->constrained('orders');
            $table->integer('quantity');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_additions');
    }
};
