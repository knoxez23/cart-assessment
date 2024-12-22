<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Relating order items to the order
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relating order items to products
            $table->integer('quantity'); // Quantity of the product
            $table->decimal('price', 10, 2); // Price of the product
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }

};
