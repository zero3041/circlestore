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
        Schema::create('carrier', function (Blueprint $table) {
            $table->bigIncrements('id_carrier');
            $table->boolean('active')->nullable()->default(1);
            $table->string('name');
            $table->decimal('price',12,2);
            $table->string('url');
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrier');
    }
};
