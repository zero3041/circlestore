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
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id_category');
            $table->integer('id_parent')->unsigned();
            $table->boolean('active')->nullable()->default(1);
            $table->boolean('show_home')->nullable()->default(0);
            $table->integer('level')->unsigned();
            $table->integer('position')->unsigned();
            $table->string('name');
            $table->string('url');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
