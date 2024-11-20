<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Almacen;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Producto;
use App\Models\Inventario;
use App\Exports\ReporteGlobalExport;
use App\Exports\ReporteInventarioExport;

class InventarioController extends Controller
{

    public function index(Request $request)
    {
        // Obtener todos los almacenes para el dropdown
        $almacenes = Almacen::all();

        // Determinar el almacén seleccionado (default: primer almacén)
        $almacenSeleccionado = $request->input('almacen', $almacenes->first()->id ?? null);

        // Consultar los productos y su stock en el almacén seleccionado
        $productos = DB::table('productos')
            ->join('stock', 'productos.id_producto', '=', 'stock.id_articulo')
            ->select('productos.nombre', 'productos.id_producto', 'stock.stock')
            ->where('stock.id_almacen', $almacenSeleccionado)
            ->get();

        return view('inventario.index', compact('almacenes', 'almacenSeleccionado', 'productos'));
    }


    public function ajustarInventario(Request $request, $id)
    {
        $data = $request->validate([
            'nuevo_stock' => 'required|integer|min:0',
            'id_almacen' => 'required|integer', // Asegúrate de recibir este valor desde el formulario
            'descripcion' => 'required|string|max:255', // Descripción para el ajuste
        ]);

        // Llamar al procedimiento almacenado con los cinco parámetros
        DB::statement('CALL RegistrarAjusteInventario(?, ?, ?, ?, ?)', [
            $data['id_almacen'],       // ID del almacén
            $id,                       // ID del artículo
            $data['nuevo_stock'],      // Ajuste en cantidad
            $data['descripcion'],      // Descripción del ajuste
            $usuarioId = Auth::user()->id        // ID del usuario autenticado (quien realiza el ajuste)
        ]);

        return redirect()->back()->with('success', 'Ajuste de inventario realizado correctamente.');
    }

    public function movimientosProducto($idProducto)
    {
        // Llamar al procedimiento almacenado para obtener el reporte de movimientos
        $movimientos = DB::select('CALL sp_generar_reporte_movimientos_producto(?)', [$idProducto]);

        // Obtener información básica del producto para mostrar en la vista
        $producto = DB::table('productos')->where('id_producto', $idProducto)->first();

        if (!$producto) {
            return redirect()->route('inventario.reporte_global')->with('error', 'Producto no encontrado.');
        }

        // Pasar los datos a la vista
        return view('inventario.movimientos', compact('movimientos', 'producto'));
    }

    public function generarReporte()
    {
        // Llamar al procedimiento almacenado para generar el informe
        $reporte = DB::select('CALL sp_generar_informe_inventario()');

        // Generar descarga o vista
        return view('inventario.reporte', compact('reporte'));
    }

    public function reporteGlobal()
    {
        // Ejecutar el procedimiento almacenado
        $reporteGlobal = DB::select('CALL sp_generar_reporte_global()');

        // Pasar los datos a la vista
        return view('inventario.reporte_global', compact('reporteGlobal'));
    }

    public function exportarReportePDF()
    {
        $reporte = DB::select('CALL sp_generar_informe_inventario()');
        $pdf = PDF::loadView('inventario.reporte_pdf', compact('reporte'));
        return $pdf->download('reporte_inventario.pdf');
    }

    public function exportarReporteXLSX()
    {
        return Excel::download(new ReporteInventarioExport, 'reporte_inventario.xlsx');
    }

    public function exportarReporteGlobalPDF()
    {
        $reporteGlobal = DB::select('CALL sp_generar_reporte_global()');
        $pdf = PDF::loadView('inventario.reporte_global_pdf', compact('reporteGlobal'));
        return $pdf->download('reporte_global.pdf');
    }

    public function exportarReporteGlobalXLSX()
    {
        return Excel::download(new ReporteGlobalExport, 'reporte_global.xlsx');
    }
}
