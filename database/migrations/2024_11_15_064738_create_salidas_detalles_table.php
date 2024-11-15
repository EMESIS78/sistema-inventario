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
        Schema::create('salidas_detalles', function (Blueprint $table) {
            $table->id('id_salida_detalle');
            $table->unsignedBigInteger('id_salida')->constrained('salidas');
            $table->unsignedBigInteger('id_articulo')->constrained('productos');
            $table->integer('cantidad');
            $table->timestamps();

        // Claves foráneas
            $table->foreign('id_salida')->references('id_salida')->on('salidas')->onDelete('cascade');
            $table->foreign('id_articulo')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas_detalles');
    }
};
