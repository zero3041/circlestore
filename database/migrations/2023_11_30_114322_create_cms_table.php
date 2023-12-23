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
        Schema::create('cms', function (Blueprint $table) {
            $table->bigIncrements('id_cms');
            $table->integer('position')->unsigned();
            $table->boolean('active')->default(1);
            $table->string('title');
            $table->longText('description');
            $table->boolean('show_home')->default(0);
            $table->string('link_rewrite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
