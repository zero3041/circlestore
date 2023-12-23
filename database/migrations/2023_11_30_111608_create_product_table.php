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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->bigInteger('id_manufacturer')->unsigned()->default(0);
            $table->bigInteger('id_tax')->unsigned()->default(0);
            $table->boolean('show_price')->default(1);
            $table->boolean('active')->default(1);
            $table->boolean('hot')->nullable()->default(0);
            $table->boolean('on_sale')->nullable()->default(0);
            $table->string('name');
            $table->text('description_short')->nullable();
            $table->longText('description')->nullable();
            $table->integer('quantity');
            $table->decimal('price',12,2);
            $table->decimal('price_tax',12,2);
            $table->decimal('price_sale',12,2)->default(0);
            $table->double('width')->nullable()->default(0);
            $table->double('height')->nullable()->default(0);
            $table->double('depth')->nullable()->default(0);
            $table->double('weight')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::table('product', function ($table) {
            $table->foreign('id_tax')
                ->references('id_tax')->on('tax')
                ->onDelete('cascade');
            $table->foreign('id_manufacturer')
                ->references('id_manufacturer')->on('manufacturer')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
