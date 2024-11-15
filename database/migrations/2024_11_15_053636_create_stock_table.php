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
        Schema::create('stock', function (Blueprint $table) {
            $table->id('id_stock');
            $table->unsignedBigInteger('id_articulo');
            $table->unsignedBigInteger('id_almacen');
            $table->integer('stock');
            $table->timestamps();

        // Claves foráneas
            $table->foreign('id_articulo')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_almacen')->references('id')->on('almacenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
