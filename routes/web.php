<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\TrasladoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Http;


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
    Route::get('/productos/buscar-codigo', [ProductoController::class, 'buscarPorCodigo'])->name('productos.buscar.codigo');
    Route::post('/productos/buscar-codigo', [ProductoController::class, 'buscarPorCodigo'])->name('productos.buscar.codigo');

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
    Route::get('/inventario/kardexvalorado', [InventarioController::class, 'reporteKardexValorado'])->name('inventario.kardexvalorado');
    Route::get('/inventario/kardexvalorado/pdf', [InventarioController::class, 'exportarKardexValoradoPDF'])->name('inventario.kardexvalorado.pdf');

    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/entradas/create', [EntradaController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');
    Route::get('/entradas/reporte-pdf', [EntradaController::class, 'exportarReportePDF'])->name('entradas.reporte_pdf');
    Route::get('/entradas/{id}/detalles', [EntradaController::class, 'detalles'])->name('entradas.detalles');

    Route::get('/salidas', [SalidaController::class, 'index'])->name('salidas.index');
    Route::get('/salidas/create', [SalidaController::class, 'create'])->name('salidas.create'); // Para mostrar el formulario de nueva salida
    Route::post('/salidas', [SalidaController::class, 'store'])->name('salidas.store'); // Para guardar la nueva salida
    Route::post('/salidas/buscar-detalle', [SalidaController::class, 'buscarDetalleEntrada'])->name('salidas.buscarDetalle');
    Route::get('/salidas/reporte-pdf', [SalidaController::class, 'exportarReportePDF'])->name('salidas.reporte_pdf');
    Route::get('/salidas/{id}/detalles', [SalidaController::class, 'detalles'])->name('salidas.detalles');

    Route::get('/traslados', [TrasladoController::class, 'index'])->name('traslados.index');
    Route::get('/traslados/create', [TrasladoController::class, 'create'])->name('traslados.create');
    Route::post('/traslados', [TrasladoController::class, 'store'])->name('traslados.store');
    Route::get('/traslados/reporte-pdf', [TrasladoController::class, 'exportarReportePDF'])->name('traslados.reporte_pdf');
    Route::get('/traslados/{id}/detalles', [TrasladoController::class, 'detalles'])->name('traslados.detalles');
    Route::get('/traslados/{id}/guia', [TrasladoController::class, 'guia'])->name('traslados.guia');
    Route::get('/traslados/{id}/guia', [TrasladoController::class, 'generarGuiaPDF'])->name('traslados.guia');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/proveedor/buscar/{ruc}', function ($ruc) {
        $token = 'apis-token-11995.mTQmgcINTb0VWszAJs4L9LEFkvF9mazQ';

        try {
            $response = Http::withOptions(['verify' => false])->withHeaders([
                'Authorization' => "Bearer $token"
            ])->get("https://api.apis.net.pe/v1/ruc", ['numero' => $ruc]);

            if ($response->ok() && isset($response['nombre'])) {
                return response()->json([
                    'success' => true,
                    'nombre' => $response['nombre']
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No se encontró información para este RUC o hubo un error en la API.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    });
    Route::get('/proveedor', [ProveedorController::class, 'index'])->name('proveedores.index');
});

// Rutas para login y registro si no están autenticados
Route::middleware(['guest'])->group(function () {
    // Rutas de login y registro
    // Jetstream ya maneja estas rutas automáticamente.
});
