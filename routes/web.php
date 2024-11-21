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
    Route::post('/almacenes', [AlmacenController::class, 'store'])->name('almacenes.store'); // Guardar nuevo almacén
    Route::get('/almacenes/{id}/edit', [AlmacenController::class, 'edit'])->name('almacenes.edit'); // Formulario de edición
    Route::put('/almacenes/{id}', [AlmacenController::class, 'update'])->name('almacenes.update'); // Actualizar almacén
    Route::delete('/almacenes/{id}', [AlmacenController::class, 'destroy'])->name('almacenes.destroy'); // Eliminar almacén


    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::post('/inventario/ajustar/{id}', [InventarioController::class, 'ajustarInventario'])->name('inventario.ajustar');
    Route::get('/inventario/movimientos/{idProducto}', [InventarioController::class, 'movimientosProducto'])->name('inventario.movimientos');
    Route::get('/inventario/reporte', [InventarioController::class, 'generarReporte'])->name('inventario.reporte');
    Route::get('/inventario/reporte-global', [InventarioController::class, 'reporteGlobal'])->name('inventario.reporte_global');

    Route::get('/inventario/reporte-pdf', [InventarioController::class, 'exportarReportePDF'])->name('inventario.reporte_pdf');
    Route::get('/inventario/reporte-xlsx', [InventarioController::class, 'exportarReporteXLSX'])->name('inventario.reporte_xlsx');
    Route::get('/inventario/reporte-global-pdf', [InventarioController::class, 'exportarReporteGlobalPDF'])->name('inventario.reporte_global_pdf');
    Route::get('/inventario/reporte-global-xlsx', [InventarioController::class, 'exportarReporteGlobalXLSX'])->name('inventario.reporte_global_xlsx');

    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/entradas/create', [EntradaController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');

    Route::get('/salidas', [SalidaController::class, 'index'])->name('salidas.index');
    Route::get('/salidas/create', [SalidaController::class, 'create'])->name('salidas.create'); // Para mostrar el formulario de nueva salida
    Route::post('/salidas', [SalidaController::class, 'store'])->name('salidas.store'); // Para guardar la nueva salida

    Route::get('/traslados', [TrasladoController::class, 'index'])->name('traslados.index');
});

// Rutas para login y registro si no están autenticados
Route::middleware(['guest'])->group(function () {
    // Rutas de login y registro
    // Jetstream ya maneja estas rutas automáticamente.
});
