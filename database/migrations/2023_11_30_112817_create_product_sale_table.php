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
        Schema::create('product_sale', function (Blueprint $table) {
            $table->bigIncrements('id_product_sale');
            $table->bigInteger('id_product')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->double('value')->unsigned();
            $table->boolean('condition');
            $table->boolean('active');
            $table->timestamps();
        });
        Schema::table('product_sale', function ($table) {
            $table->foreign('id_product')
                ->references('id_product')->on('product')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sale');
    }
};
