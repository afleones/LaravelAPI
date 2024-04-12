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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->references('id')->on('users');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('role_people');
            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->nullable(false)->references('id')->on('people')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['people_id']);
        });

        Schema::create('director', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->nullable(false)->references('id')->on('people')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['people_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
        Schema::dropIfExists('player');
        Schema::dropIfExists('director');
    }
};
