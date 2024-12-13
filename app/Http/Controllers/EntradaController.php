<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Almacen;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Http;

class EntradaController extends Controller
{
    public function index(Request $request)
    {
        // List all entries if needed
        $search = $request->input('search');
        $entradas = Entrada::with('almacen', 'usuario')
            ->when($search, function ($query) use ($search) {
                $query->where('documento', 'LIKE', "%$search%")
                    ->orWhere('id_proveedor', 'LIKE', "%$search%");
            })
            ->get();
        return view('entradas.index', compact('entradas'));
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $validatedData = $request->validate([
            'id_almacen' => 'required|integer',
            'documento' => 'required|string|max:255',
            'id_proveedor' => 'required|string|max:20',
            'productos' => 'required|array',
            'productos.*.codigo' => 'required|string|max:255',
            'productos.*.id_articulo' => 'required|string',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0.01',
        ]);


        try {
            // Verificar si el proveedor ya existe
            $proveedor = Proveedor::find($validatedData['id_proveedor']);

            if (!$proveedor) {
                // Hacer la solicitud a la API
                $response = Http::withoutVerifying()->get("https://api.apis.net.pe/v1/ruc", [
                    'numero' => $validatedData['id_proveedor']
                ]);

                if ($response->ok() && $response->json('nombre')) {
                    // Registrar el nuevo proveedor en la base de datos
                    Proveedor::create([
                        'id_ruc_proveedor' => $validatedData['id_proveedor'],
                        'nombres' => $response->json('nombre'),
                    ]);
                } else {
                    return back()->withErrors(['error' => 'No se pudo obtener el nombre del proveedor.']);
                }
            }


            // Convertir los productos a formato JSON
            $productosJson = json_encode($validatedData['productos']);

            // Llamar al procedimiento almacenado con el id del usuario
            DB::statement('CALL RegistrarEntrada(?, ?, ?, ?, ?)', [
                $validatedData['id_almacen'],
                $validatedData['documento'],
                $validatedData['id_proveedor'],
                $productosJson,
                Auth::id(), // Pasar el ID del usuario autenticado
            ]);

            // Redirigir al índice con un mensaje de éxito
            return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente.');
        } catch (\Exception $e) {
            // Manejar errores
            return back()->withErrors(['error' => 'Error al registrar la entrada: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        // Obtener todos los almacenes para mostrar en el formulario
        $almacenes = Almacen::all();
        return view('entradas.create', compact('almacenes'));
    }

    public function exportarReportePDF()
    {
        if (Auth::user()->rol !== 'admin') {
            abort(403, 'No tiene permiso para realizar esta acción.');
        }

        $entradas = Entrada::with(['almacen', 'usuario'])->get();

        $pdf = PDF::loadView('entradas.reporte', compact('entradas'));
        return $pdf->download('reporte_entradas.pdf');
    }

    public function detalles($id)
    {
        $entrada = Entrada::with(['almacen', 'usuario'])->findOrFail($id);
        $detalles = DB::table('entradas_detalles')
            ->join('productos', 'entradas_detalles.id_articulo', '=', 'productos.id_producto')
            ->where('entradas_detalles.id_entrada', $id)
            ->select(
                'productos.nombre as producto',
                'entradas_detalles.cantidad',
                'entradas_detalles.precio_unitario'
            )
            ->get();

        return view('entradas.detalles', compact('entrada', 'detalles'));
    }
}
