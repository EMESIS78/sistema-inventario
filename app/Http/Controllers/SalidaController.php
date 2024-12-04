<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Salida;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SalidaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $salidas = Salida::with('almacen', 'usuario')
        ->when($search, function ($query) use ($search) {
            $query->where('motivo', 'LIKE', "%$search%")
                ->orWhereHas('almacen', function ($query) use ($search) {
                    $query->where('nombre', 'LIKE', "%$search%"); // Buscar en el nombre del almacén
                });
        })
        ->orderBy('created_at', 'desc')
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
            $productosJson = json_encode($validatedData['productos']);

            DB::statement('CALL RegistrarSalida(?, ?, ?, ?)', [
                $validatedData['id_almacen'],
                $validatedData['motivo'],
                $productosJson,
                Auth::id(), // ID del usuario autenticado
            ]);

            return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al registrar la salida: ' . $e->getMessage()]);
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

    public function exportarReportePDF()
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'No tiene permiso para realizar esta acción.');
        }

        $salidas = DB::table('salidas')
            ->join('almacenes', 'salidas.id_almacen', '=', 'almacenes.id')
            ->join('users', 'salidas.user_id', '=', 'users.id')
            ->select('salidas.*', 'almacenes.nombre as almacen_nombre', 'users.name as usuario_nombre')
            ->orderBy('salidas.created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('salidas.reporte', compact('salidas'));
        return $pdf->download('reporte_salidas.pdf');
    }

    public function detalles($id)
    {
        $salida = DB::table('salidas')
            ->join('almacenes', 'salidas.id_almacen', '=', 'almacenes.id')
            ->join('users', 'salidas.user_id', '=', 'users.id')
            ->where('salidas.id_salida', $id)
            ->select('salidas.*', 'almacenes.nombre as almacen_nombre', 'users.name as usuario_nombre')
            ->first();

        $detalles = DB::table('salidas_detalles')
            ->join('productos', 'salidas_detalles.id_articulo', '=', 'productos.id_producto')
            ->where('salidas_detalles.id_salida', $id)
            ->select('productos.nombre as producto', 'salidas_detalles.cantidad')
            ->get();

        return view('salidas.detalles', compact('salida', 'detalles'));
    }
}
