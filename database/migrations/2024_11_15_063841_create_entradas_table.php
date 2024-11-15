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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id('id_entrada');
            $table->unsignedBigInteger('id_almacen');
            $table->string('documento');
            $table->unsignedBigInteger('id_proveedor');
            $table->timestamps();

        // Claves foráneas
            $table->foreign('id_almacen')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id_ruc_proveedor')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
