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
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->bigInteger('id_carrier')->unsigned();
            $table->bigInteger('id_customer')->unsigned();
            $table->string('payment');
            $table->string('tracking_number')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->double('total_discount')->unsigned();
            $table->double('total_shipping')->unsigned();
            $table->double('total_price')->unsigned();
            $table->double('total_tax')->unsigned();
            $table->double('total_price_tax')->unsigned();
            $table->integer('status')->unsigned();
            $table->integer('check')->unsigned();
            $table->timestamps();
        });
        Schema::table('order', function ($table) {
            $table->foreign('id_customer')
                ->references('id_customer')->on('web')
                ->onDelete('cascade');
            $table->foreign('id_carrier')
                ->references('id_carrier')->on('carrier')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
