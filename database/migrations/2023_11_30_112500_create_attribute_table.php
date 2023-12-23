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
        Schema::create('attribute', function (Blueprint $table) {
            $table->bigIncrements('id_attribute');
            $table->bigInteger('id_attribute_group')->unsigned();
            $table->mediumInteger('position')->unsigned();
            $table->string('color',100)->nullable();
            $table->string('name');
        });
        Schema::table('attribute', function ($table) {
            $table->foreign('id_attribute_group')
                ->references('id_attribute_group')->on('attribute_group')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute');
    }
};
