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
        Schema::create('web', function (Blueprint $table) {
            $table->bigIncrements('id_customer');
            $table->boolean('is_gender')->default(0);
            $table->boolean('active')->nullable()->default(1);
            $table->integer('id_lang')->unsigned();
            $table->integer('id_country')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('phone_number');
            $table->date('birthday')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web');
    }
};
