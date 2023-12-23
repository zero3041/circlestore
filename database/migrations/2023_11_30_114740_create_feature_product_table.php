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
        Schema::create('feature_product', function (Blueprint $table) {
            $table->bigInteger('id_feature')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_feature_value')->unsigned();
            $table->primary(['id_feature','id_product']);

        });
        Schema::table('feature_product', function ($table) {
            $table->foreign('id_product')
                ->references('id_product')->on('product')
                ->onDelete('cascade');
            $table->foreign('id_feature')
                ->references('id_feature')->on('feature')
                ->onDelete('cascade');
            $table->foreign('id_feature_value')
                ->references('id_feature_value')->on('feature_value')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_product');
    }
};
