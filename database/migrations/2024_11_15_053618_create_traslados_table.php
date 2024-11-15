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
        Schema::create('traslados', function (Blueprint $table) {
            $table->bigIncrements('id_traslado');
            $table->unsignedBigInteger('id_almacen_salida');
            $table->unsignedBigInteger('id_almacen_entrada');
            $table->string('motivo');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_almacen_salida')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('id_almacen_entrada')->references('id')->on('almacenes')->onDelete('cascade');

            // Establecer el motor InnoDB
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslados');
    }
};
