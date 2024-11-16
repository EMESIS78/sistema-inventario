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
        Schema::create('ajustes_inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_almacen');
            $table->unsignedBigInteger('id_articulo');
            $table->integer('cantidad_ajuste');
            $table->string('motivo', 255);
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario');

            // Foreign keys
            $table->foreign('id_almacen')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('id_articulo')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajustes_inventario');
    }
};
