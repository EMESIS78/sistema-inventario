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
        Schema::create('traslados_detalles', function (Blueprint $table) {
            $table->bigIncrements('id_traslado_detalle');
            $table->unsignedBigInteger('id_traslado'); // Asegúrate de usar unsignedBigInteger
            $table->unsignedBigInteger('id_articulo');
            $table->integer('cantidad');
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_traslado')->references('id_traslado')->on('traslados')->onDelete('cascade');
            $table->foreign('id_articulo')->references('id_producto')->on('productos')->onDelete('cascade');

            // Establecer motor InnoDB
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslados_detalles');
    }
};
