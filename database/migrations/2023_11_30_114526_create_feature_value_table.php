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
        Schema::create('feature_value', function (Blueprint $table) {
            $table->bigIncrements('id_feature_value');
            $table->bigInteger('id_feature')->unsigned();
            $table->string('value');
        });
        Schema::table('feature_value', function ($table) {
            $table->foreign('id_feature')
                ->references('id_feature')->on('feature')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_value');
    }
};
