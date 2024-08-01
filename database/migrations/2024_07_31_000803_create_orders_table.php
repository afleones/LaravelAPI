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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_category_article')->constrained('categories_articles')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_user')->constrained('users')->onDelete('no action')->onUpdate('no action');
            $table->text('delivery_address')->nullable();            
            $table->foreignId('id_size')->nullable()->constrained('sizes')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_flavor')->nullable()->constrained('flavors')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_form')->nullable()->constrained('forms')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_filling')->nullable()->constrained('fillings')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('id_design')->nullable()->constrained('designs')->onDelete('no action')->onUpdate('no action');
            $table->decimal('subtotal_order', 15, 2)->default(0.00);
            $table->decimal('total_tax', 15, 2)->default(0.00)->nullable();
            $table->decimal('total_discount', 15, 2)->default(0.00)->nullable();
            $table->decimal('total_order', 15, 2)->default(0.00);
            $table->date('date_order');
            $table->time('time_order');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
