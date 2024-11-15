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
        Schema::create('entradas_detalles', function (Blueprint $table) {
            $table->id('id_entrada_detalle');
            $table->unsignedBigInteger('id_entrada')->constrained('entradas');
            $table->unsignedBigInteger('id_articulo')->constrained('productos');
            $table->integer('cantidad');
            $table->timestamps();

        // Claves foráneas
            $table->foreign('id_entrada')->references('id_entrada')->on('entradas')->onDelete('cascade');
            $table->foreign('id_articulo')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas_detalles');
    }
};
