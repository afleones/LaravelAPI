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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('serial');
            $table->string('supplier');
            $table->integer('quantities');
            $table->unsignedBigInteger('category_id'); // Aquí se define la clave foránea
            $table->unsignedBigInteger('supplier_id'); // Aquí se define la clave foránea
            $table->boolean('state');
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('Suppliers')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
