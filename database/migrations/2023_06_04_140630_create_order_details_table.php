<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->bigInteger('product_id')->nullable();
            $table->primary(['order_id','product_id']);
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('unit_price', $precision = 8, $scale = 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
