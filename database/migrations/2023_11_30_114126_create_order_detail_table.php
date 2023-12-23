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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->bigIncrements('id_order_detail');
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->integer('id_product_attribute')->unsigned();
            $table->integer('product_quantity')->unsigned();
            $table->string('product_name');

        });
        Schema::table('order_detail', function ($table) {
            $table->foreign('id_product')
                ->references('id_product')->on('product')
                ->onDelete('cascade');
            $table->foreign('id_order')
                ->references('id_order')->on('order')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
