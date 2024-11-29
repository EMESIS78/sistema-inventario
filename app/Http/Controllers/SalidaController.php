<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Almacen;
use App\Models\Producto;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = DB::table('salidas')
            ->join('almacenes', 'salidas.id_almacen', '=', 'almacenes.id')
            ->select('salidas.*', 'almacenes.nombre as almacen_nombre')
            ->orderBy('salidas.created_at', 'desc')
            ->get();

        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        $almacenes = Almacen::all();
        $productos = Producto::all();

        return view('salidas.create', compact('almacenes', 'productos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_almacen' => 'required|exists:almacenes,id',
            'motivo' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id_articulo' => 'required|string',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        try {
            DB::statement('CALL RegistrarSalida(?, ?, ?)', [
                $validatedData['id_almacen'],
                $validatedData['motivo'],
                json_encode($validatedData['productos']),
            ]);

            return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function buscarDetalleEntrada(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|max:255',
        ]);

        $documento = $request->input('documento');

        try {
            $detalleEntrada = DB::select('CALL ObtenerDetalleEntrada(?)', [$documento]);

            if (empty($detalleEntrada)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron detalles para el documento proporcionado.',
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $detalleEntrada,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar el detalle de la entrada: ' . $e->getMessage(),
            ]);
        }
    }
}
