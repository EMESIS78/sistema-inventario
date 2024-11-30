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
        // Modificar la tabla 'entradas'
        Schema::table('entradas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id_entrada'); // Campo user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Llave foránea
        });

        // Modificar la tabla 'salidas'
        Schema::table('salidas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id_salida');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // Modificar la tabla 'traslados'
        Schema::table('traslados', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id_traslado');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir los cambios en la tabla 'entradas'
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        // Revertir los cambios en la tabla 'salidas'
        Schema::table('salidas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        // Revertir los cambios en la tabla 'traslados'
        Schema::table('traslados', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
