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
        Schema::create('categories_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_category')->constrained('categories')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_article')->constrained('articles')->onDelete('no action')->onUpdate('no action');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_articles');
    }
};
