<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traslado;
use Illuminate\Support\Facades\Route;
use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TrasladoController extends Controller
{
    // Mostrar todos los traslados
    public function index(Request $request)
    {
        $search = $request->input('search');
        $traslados = Traslado::with(['almacenSalida', 'almacenEntrada', 'usuario'])
            ->when($search, function ($query) use ($search) {
                $query->where('motivo', 'LIKE', "%$search%")
                    ->orWhereHas('almacenSalida', function ($query) use ($search) {
                        $query->where('nombre', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('almacenEntrada', function ($query) use ($search) {
                        $query->where('nombre', 'LIKE', "%$search%");
                    });
            })
            ->get();

        return view('traslados.index', compact('traslados'));
    }

    public function create()
    {
        $almacenes = Almacen::all();
        $productos = Producto::all();
        return view('traslados.create', compact('almacenes', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_almacen_salida' => 'required|exists:almacenes,id',
            'id_almacen_entrada' => 'required|exists:almacenes,id',
            'motivo' => 'required|string|max:255',
            'placa_vehiculo' => 'required|string|max:255',
            'guia' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id_articulo' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);


        foreach ($validated['productos'] as $producto) {
            $stock = DB::table('stock')
                ->where('id_articulo', $producto['id_articulo'])
                ->where('id_almacen', $validated['id_almacen_salida'])
                ->value('stock');

            if ($stock < $producto['cantidad']) {
                return back()->withErrors("No hay suficiente stock para el producto: {$producto['id_articulo']} en el almacén de salida.");
            }
        }

        // Lógica para almacenar el traslado y modificar el stock
        try {
            DB::beginTransaction();

            // Registrar el traslado en la base de datos o llamar al procedimiento almacenado
            DB::statement('CALL RegistrarTraslado(?, ?, ?, ?, ?, ?, ?)', [
                $validated['id_almacen_salida'],
                $validated['id_almacen_entrada'],
                $validated['motivo'],
                json_encode($validated['productos']), // Convertir productos a JSON
                Auth::id(),
                $validated['placa_vehiculo'],
                $validated['guia'],
            ]);

            // Actualizar el stock en los almacenes
            foreach ($validated['productos'] as $producto) {
                // Reducir stock en el almacén de salida
                DB::table('stock')
                    ->where('id_articulo', $producto['id_articulo'])
                    ->where('id_almacen', $validated['id_almacen_salida'])
                    ->decrement('stock', $producto['cantidad']);

                // Aumentar stock en el almacén de entrada
                DB::table('stock')
                    ->where('id_articulo', $producto['id_articulo'])
                    ->where('id_almacen', $validated['id_almacen_entrada'])
                    ->increment('stock', $producto['cantidad']);
            }

            DB::commit();

            return redirect()->route('traslados.index')->with('success', 'Traslado registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('traslados.index')->with('error', 'Error al ejecutar el procedimiento: ' . $e->getMessage());
        }
    }

    public function exportarReportePDF()
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'No tiene permiso para realizar esta acción.');
        }

        $traslados = Traslado::with(['almacenSalida', 'almacenEntrada', 'usuario'])->get();

        $pdf = PDF::loadView('traslados.reporte', compact('traslados'));
        return $pdf->download('reporte_traslados.pdf');
    }
    // Mostrar un traslado específico
    public function detalles($id)
    {
        $traslado = Traslado::with(['almacenSalida', 'almacenEntrada', 'usuario'])->findOrFail($id);

        $detalles = DB::table('traslados_detalles')
            ->join('productos', 'traslados_detalles.id_articulo', '=', 'productos.id_producto')
            ->where('traslados_detalles.id_traslado', $id)
            ->select('productos.nombre as producto', 'traslados_detalles.cantidad')
            ->get();

        return view('traslados.detalles', compact('traslado', 'detalles'));
    }

    public function generarGuiaPDF($id)
    {
        // Obtener el traslado y sus detalles
        $traslado = Traslado::with(['almacenSalida', 'almacenEntrada', 'usuario'])->findOrFail($id);

        $detalles = DB::table('traslados_detalles')
            ->join('productos', 'traslados_detalles.id_articulo', '=', 'productos.id_producto')
            ->where('traslados_detalles.id_traslado', $id)
            ->select('productos.nombre as producto', 'traslados_detalles.cantidad')
            ->get();

        // Renderizar la vista de la guía como PDF
        $pdf = PDF::loadView('traslados.guia', compact('traslado', 'detalles'));

        // Mostrar en el navegador
        return $pdf->stream('guia_remision_' . $traslado->id_traslado . '.pdf');
    }
}
