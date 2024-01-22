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
        Schema::create('category_voucher', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('position')->unsigned();
            $table->primary(['voucher_id','category_id']);
        });
        Schema::table('category_voucher', function ($table) {
            $table->foreign('voucher_id')
                ->references('id')->on('vouchers')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id_category')->on('category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_voucher');
    }
};
