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
        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id_review');
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_customer')->unsigned();
            $table->string('content');
            $table->integer('vote')->unsigned();
            $table->timestamps();
        });
        Schema::table('review', function ($table) {
            $table->foreign('id_product')
                ->references('id_product')->on('product')
                ->onDelete('cascade');
            $table->foreign('id_customer')
                ->references('id_customer')->on('web')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
