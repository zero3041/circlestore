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
        Schema::create('attribute_group', function (Blueprint $table) {
            $table->bigIncrements('id_attribute_group');
            $table->boolean('is_color')->default(0);
            $table->string('group_type',100);
            $table->mediumInteger('position')->unsigned();
            $table->string('name',250);
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_group');
    }
};
