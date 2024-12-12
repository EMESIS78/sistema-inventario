<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['UNIDAD', 'DOCENA', 'MILLAR', 'ROLLO', 'METRO', 'KILO', 'CAJA', 'BOLSA', 'LITRO'];

        for ($i = 1; $i <= 100; $i++) {
            DB::table('productos')->insert([
                'codigo' => Str::random(10), // Código de barras aleatorio
                'nombre' => 'Producto ' . $i,
                'marca' => 'Marca ' . chr(65 + $i % 26), // Generar marcas A-Z
                'unidad_medida' => $units[array_rand($units)],
                'ubicacion' => 'Estantería ' . rand(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
