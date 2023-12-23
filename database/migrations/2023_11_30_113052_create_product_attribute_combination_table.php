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
        Schema::create('product_attribute_combination', function (Blueprint $table) {
            $table->bigInteger('id_attribute')->unsigned();
            $table->bigInteger('id_product_at')->unsigned();
            $table->primary(['id_attribute','id_product_at']);
        });
        Schema::table('product_attribute_combination', function ($table) {
            $table->foreign('id_attribute')
                ->references('id_attribute')->on('attribute')
                ->onDelete('cascade');
            $table->foreign('id_product_at')
                ->references('id_product_attribute')->on('product_attribute')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_combination');
    }
};
