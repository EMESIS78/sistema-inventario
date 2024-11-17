<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\TrasladoController;

Route::get('/', function () {
    return view('menu');
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('menu');
    })->name('menu');
    Route::get('/articulos', [ProductoController::class, 'index'])->name('articulos.index');
    // Ruta para mostrar el formulario de creación de artículos
    Route::get('/articulos/create', [ProductoController::class, 'create'])->name('articulos.create');
    // Ruta para guardar un artículo (almacenar en la base de datos)
    Route::post('/articulos', [ProductoController::class, 'store'])->name('articulos.store');
    Route::get('/articulos/{id}/edit', [ProductoController::class, 'edit'])->name('articulos.edit');
    Route::put('/articulos/{id}', [ProductoController::class, 'update'])->name('articulos.update');
    Route::delete('/articulos/{id}', [ProductoController::class, 'destroy'])->name('articulos.destroy');


    Route::get('/almacenes', [AlmacenController::class, 'index'])->name('almacenes.index');
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/salidas', [SalidaController::class, 'index'])->name('salidas.index');
    Route::get('/traslados', [TrasladoController::class, 'index'])->name('traslados.index');
});

// Rutas para login y registro si no están autenticados
Route::middleware(['guest'])->group(function () {
    // Rutas de login y registro
    // Jetstream ya maneja estas rutas automáticamente.
});
