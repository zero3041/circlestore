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
        Schema::create('product_attribute_image', function (Blueprint $table) {
            $table->bigInteger('id_product_attribute')->unsigned();
            $table->bigInteger('id_image')->unsigned();
            $table->primary(['id_product_attribute','id_image']);
        });
        Schema::table('product_attribute_image', function ($table) {
            $table->foreign('id_product_attribute')
                ->references('id_product_attribute')->on('product_attribute')
                ->onDelete('cascade');
            $table->foreign('id_image')
                ->references('id_image')->on('product_image')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_image');
    }
};
